<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Document;
use App\Models\Inbound;
use App\Models\Inlocation;
use App\Models\Outbound;
use App\Models\User;
use App\Notifications\DocumentNotification;
use App\Notifications\LocationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    public function process(Request $request, $type, $id)
    {
        try {
            $user = auth()->user();

            if ($type == 'inbounds') {
                $transaction = Inbound::find($id);
                $asset = Asset::where('asset_number', $transaction->asset_number)->firstOrFail();
            } elseif ($type == 'outbounds') {
                $transaction = Outbound::find($id);
                $asset = Asset::where('sto_number', $transaction->sto_number)->firstOrFail();
            }

            $request->validate([
                'action' => 'required|in:Approved,Reject',
            ]);

            // Update transaction approval status
            $transaction->update([
                'approval_status' => $request->action,
                'approval_by' => $user->id,
            ]);

            if ($request->action === 'Approved') {
                // Handle approval logic based on transaction type
                if ($type === 'inbounds') {
                    if ($transaction->conditions_id === 4) {
                        $asset->update([
                            'category_statuses_id' => 1,
                        ]);

                        $transaction->update([
                            'category_statuses_id' => 1,
                        ]);

                        $this->createDocument($asset, 'inbound');
                    } elseif ($transaction->conditions_id === 5) {
                        $asset->update([
                            'category_statuses_id' => $transaction->category_statuses_id,
                        ]);

                        $this->createDocument($asset, 'return');

                        $transaction->update([
                            'category_statuses_id' => 2,
                        ]);
                    }
                } elseif ($type === 'outbounds') {
                    $asset->update([
                        'category_statuses_id' => 3,
                    ]);

                    $this->createDocument($asset, 'outbound');

                    $transaction->update([
                        'category_statuses_id' => $asset->category_statuses_id,
                        'conditions_id' => 1,
                    ]);

                    Inlocation::create([
                        'loc_number' => $this->generateLocNumber($transaction->location_id),
                        'location_id' => $transaction->location_id,
                        'sto_number' => $transaction->sto_number,
                    ]);
                }
            }

            $redirectRoute = ($user->role == 'admin') ? 'documents.index' : 'approval.index';

            $message = ($request->action == 'Approved') ? 'Approval' : 'Reject';
            return redirect()->route($redirectRoute)->with('success', "{$message} processed successfully");
        } catch (\Exception $e) {
            return redirect()->route('approval.index')->with('error', 'Failed to process approval. Error: ' . $e->getMessage());
        }
    }

    private function generateLocNumber($locationId)
    {
        try {
            // Cek apakah sudah ada data Inlocation untuk location_id tertentu
            $existingLoc = Inlocation::where('location_id', $locationId)->first();

            if (!$existingLoc) {
                // Jika tidak ada data Inlocation, maka buat loc_number baru
                $lastLocNumber = Inlocation::latest('loc_number')->first();
                $nextNumber = $lastLocNumber ? intval(substr($lastLocNumber->loc_number, 4)) + 1 : 1;

                // Membuat loc_number secara otomatis
                return 'LOC-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
            } else {
                // Jika sudah ada data Inlocation, gunakan loc_number yang sudah ada
                return $existingLoc->loc_number;
            }
        } catch (\Exception $e) {
            // Tangani kesalahan jika gagal menghasilkan loc_number
            throw new \Exception('Failed to generate loc_number. Error: ' . $e->getMessage());
        }
    }

    private function createDocument($asset, $transactionType)
    {
        try {

            // Mendapatkan data transaksi berdasarkan jenis transaksi
            $transactionData = null;

            if ($transactionType == 'outbound' && $asset->outbound) {
                $transactionData = $asset->outbound;
            } elseif ($transactionType == 'inbound' && $asset->inbound) {
                $transactionData = $asset->inbound;
            } elseif ($transactionType == 'return' && $asset->inbound) {
                $transactionData = $asset->inbound;
            }

            if (!$transactionData) {
                // Jika tidak ada data transaksi, lemparkan pengecualian
                throw new \Exception('Transaction data not found.');
            }

            $documentData = [
                'document_number' => $this->generateDocNumber(),
                'asset_number' => ($transactionType == 'inbound') ? $transactionData->asset_number : (($transactionType == 'return') ? $transactionData->asset_number : (($transactionType == 'outbound') ? $asset->asset_number : null)),
                'sto_number' => ($transactionType == 'outbound') ? $transactionData->sto_number : null,
                'name' => $asset->name,
                'device_id' => $asset->device_id,
                'software_id' => $asset->software_id,
                'rack_id' => ($transactionType == 'inbound') ? $transactionData->rack_id : (($transactionType == 'return') ? $transactionData->rack_id : null),
                'category_statuses_id' => $asset->category_statuses_id,
                'conditions_id' => $transactionData->conditions_id,
                'locations_id' => ($transactionType == 'outbound') ? $transactionData->location_id : null,
                'created_by' => $transactionData->created_by,
                'approval_by' => $transactionData->approval_by,
                'explanation' => $asset->explanation,
                'pic' => ($transactionType == 'outbound') ? $transactionData->pic : null,
            ];

            // Membuat dokumen baru dan menyimpannya ke tabel 'documents'
            $document = Document::create($documentData);

            // Kirim notifikasi
            $users = User::where('role', 'staff')->orWhere('role', 'admin')->get();
            foreach ($users as $user) {
                $user->notify(new DocumentNotification($document));
            }

            if ($transactionType == 'outbound') {
                $users1 = User::where('role', 'supervisor')->get();
                    foreach ($users1 as $user1) {
                        $user1->notify(new LocationNotification($document));
                    }
            }
        } catch (\Exception $e) {
            // Tangani kesalahan jika gagal membuat dokumen baru
            throw new \Exception('Failed to create document. Error: ' . $e->getMessage());
        }
    }

    private function generateDocNumber()
    {
        // Mendapatkan nomor dokumen terakhir yang dibuat
        $lastDocumentNumber = Document::latest('document_number')->first();

        $nextNumber = $lastDocumentNumber ? intval(substr($lastDocumentNumber->document_number, 6)) + 1 : 1;

        // Membuat document_number secara otomatis
        return 'DOC-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }

    public function index()
    {
        auth()->user()->unreadNotifications->where('id', request('id'))->first()?->update(['title' => 'font-weight-normal']);

        try {
            // Ambil data Inbound dan Outbound yang memiliki status approval 'Pending'
            $inbounds = Inbound::where('approval_status', 'Pending')->get();
            $outbounds = Outbound::where('approval_status', 'Pending')->get();

            return view('layouts.approval', compact('inbounds', 'outbounds'));
        } catch (\Exception $e) {
            return redirect()->route('approval.index')->with('error', 'Failed to retrieve approval data. Error: ' . $e->getMessage());
        }
    }

    public function inboundDocumentDetails($id)
    {
        try {
            $inbound = Inbound::find($id);

            return view('layouts.detailInbound', ['asset' => $inbound->asset]);
        } catch (\Exception $e) {
            return redirect()->route('approval.index')->with('error', 'Failed to retrieve details. Error: ' . $e->getMessage());
        }
    }

    public function outboundDocumentDetails($id)
    {
        try {
            $outbound = Outbound::find($id);

            return view('layouts.detailOutbound', ['asset' => $outbound->asset]);
        } catch (\Exception $e) {
            return redirect()->route('approval.index')->with('error', 'Failed to retrieve details. Error: ' . $e->getMessage());
        }
    }
}
