<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Inbound;
use App\Models\Outbound;
use App\Models\User;
use App\Notifications\InboundNotification;
use App\Notifications\OutboundNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AsetController extends Controller
{
    public function inbound(Request $request)
    {
        // Validasi form
        $request->validate([
            'name' => 'required',
            'device_id' => 'required',
            'rack_id' => 'required',
            'description' => 'required',
        ]);

        try {
            // Logika untuk membuat nomor aset
            $lastInbound = Inbound::latest('asset_number')->first();
            $nextNumber = $lastInbound ? intval(substr($lastInbound->asset_number, 4)) + 1 : 1;
            $assetNumber = 'ASN-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

            // Dapatkan user yang sedang login
            $byUser = auth()->user();

            $categoryStatusId = 4;
            $conditionId = 4;

            // Proses Inbound
            $inbound = Inbound::create([
                'asset_number' => $assetNumber,
                'name' => $request->name,
                'rack_id' => $request->rack_id,
                'category_statuses_id' => $categoryStatusId,
                'conditions_id' => $conditionId,
                'created_by' => $byUser->id,
            ]);

            Asset::create([
                'asset_number' => $assetNumber,
                'name' => $request->name,
                'device_id' => $request->device_id,
                'software_id' => $request->software_id,
                'category_statuses_id' => $categoryStatusId,
                'explanation' => $request->description,
            ]);

            // Kirim notifikasi
            $users = User::where('role', 'supervisor')->orWhere('role', 'admin')->get();
            foreach ($users as $user) {
                $user->notify(new InboundNotification($inbound));
            }

            // Tentukan rute pengalihan berdasarkan peran user
            $redirectRoute = ($byUser->role == 'staff') ? 'inbound.index' : 'approval.index';

            return redirect()->route($redirectRoute)->with('success', 'Asset successfully added');
        } catch (\Exception $e) {
            return redirect()->route('inbound.index')->with('error', 'Failed to add asset. Error:  ' . $e->getMessage());
        }
    }

    public function return(Request $request)
    {
        $request->validate([
            'asset_number' => [
                'required',
                Rule::exists('assets', 'asset_number')->whereIn('category_statuses_id', [3]),
            ],
            'description' => 'required',
            'rack_id' => 'required',
            'status_id' => 'required',
        ]);

        try {
            $asset = Asset::where('asset_number', $request->asset_number)->whereIn('category_statuses_id', [3])->firstOrFail();
            $inbound = Inbound::where('asset_number', $request->asset_number)->first();
            $user1 = auth()->user();


            if ($asset->outbound) {
                $this->processOutboundCancellation($asset->outbound);
            }

            $asset->update([
                'category_statuses_id' => 4,
                'explanation' => $request->description,
            ]);

            $inbound->update([
                'rack_id' => $request->rack_id,
                'category_statuses_id' => $request->status_id,
                'conditions_id' => 5,
                'approval_status' => 'Pending',
                'created_by'=> $user1->id,
                'approval_by'=> null,
            ]);

            // Kirim notifikasi
            $users = User::where('role', 'supervisor')->orWhere('role', 'admin')->get();
            foreach ($users as $user) {
                $user->notify(new InboundNotification($inbound));
            }

            // Tentukan rute pengalihan berdasarkan peran user
            $redirectRoute = ($user1->role == 'staff') ? 'return.index' : 'approval.index';

            return redirect()->route($redirectRoute)->with('success', 'Assets successfully returned');
        } catch (\Exception $e) {
            return redirect()->route('return.index')->with('error', 'Failed to add return. Error: ' . $e->getMessage());
        }

    }

    private function processOutboundCancellation($outbound)
    {
        try {
            $stoNumber = $outbound->sto_number;

            if ($outbound->inlocation) {
                $outbound->inlocation->delete();
            }

            $asset = $outbound->asset;
            $asset->sto_number = null;
            $asset->save();


            $outbound->delete();

            Asset::where('sto_number', $stoNumber)->update(['sto_number' => null]);

        } catch (\Exception $e) {
            throw new \Exception('Failed to process outbound cancellation. Error: ' . $e->getMessage());
        }
    }

    public function getDetailsReturn(Request $request)
    {
        $assetNumber = $request->input('asset_number');
        $asset = Asset::where('asset_number', $assetNumber)->whereIn('category_statuses_id', [3])->firstOrFail();

        return response()->json([
            'name' => $asset->name,
            'description' => $asset->explanation
        ]);
    }

    public function outbound(Request $request)
    {
        $request->validate([
            'asset_number' => [
                'required',
                Rule::exists('assets', 'asset_number')->whereIn('category_statuses_id', [1, 5]),
            ],
            'pic' => 'required',
            'location_id' => 'required',
        ]);

        try {
            $asset = Asset::where('asset_number', $request->asset_number)
                ->whereIn('category_statuses_id', [1,5])->firstOrFail();

            $lastOutbound = Outbound::latest('sto_number')->first();
            $nextNumber = $lastOutbound ? intval(substr($lastOutbound->sto_number, 4)) + 1 : 1;
            $stoNumber = 'STO-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

            $byUser = auth()->user();
            $categoryStatusId = 4;
            $conditionId = 6;

            $outbound = Outbound::create([
                'sto_number' => $stoNumber,
                'name' => $asset->name,
                'location_id' => $request->location_id,
                'category_statuses_id' => $categoryStatusId,
                'conditions_id' => $conditionId,
                'explanation' => $asset->explanation,
                'pic' => $request->pic ,
                'created_by' => $byUser->id,
            ]);

            $asset->update([
                'sto_number' => $outbound->sto_number,
                'category_statuses_id' => $categoryStatusId,
            ]);

            // Kirim notifikasi
            $users = User::where('role', 'supervisor')->orWhere('role', 'admin')->get();
            foreach ($users as $user) {
                $user->notify(new OutboundNotification($outbound));
            }

            $redirectRoute = ($byUser->role === 'staff') ? 'outbound.index' : 'approval.index';

            return redirect()->route($redirectRoute)->with('success', 'Outbound successfully added');
        } catch (\Exception $e) {
            return redirect()->route('outbound.index')->with('error', 'Failed to add outbound. Error: ' . $e->getMessage());
        }
    }

    public function getDetailsOutbound(Request $request)
    {
        $assetNumber = $request->input('asset_number');
        $asset = Asset::where('asset_number', $assetNumber)->whereIn('category_statuses_id', [1, 5])->firstOrFail();

        return response()->json([
            'name' => $asset->name,
            'device' => $asset->device->name,
            'explanation' => $asset->explanation,
        ]);
    }
}
