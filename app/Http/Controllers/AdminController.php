<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\User;
use App\Models\Device;
use App\Models\Division;
use App\Models\Rack;
use App\Models\Software;
use App\Models\CategoryStatus;
use App\Models\Condition;
use App\Models\Document;
use App\Models\Inbound;
use App\Models\Inlocation;
use App\Models\Outbound;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index()
    {
        $totalAssets = Asset::count();
        $totalInbound = Asset::whereIn('category_statuses_id', [1, 5])->count();
        $totalOutbound = Asset::whereIn('category_statuses_id', [3])->count();
        $totalRepair = Asset::whereIn('category_statuses_id', [6])->count();
        $totalLost = Asset::whereIn('category_statuses_id', [7])->count();

        return view('layouts.welcome', compact(
            'totalAssets',
            'totalInbound',
            'totalOutbound',
            'totalRepair',
            'totalLost'
        ));
    }

    function admin()
    {
        $totalAssets = Asset::count();
        $totalInbound = Asset::whereIn('category_statuses_id', [1, 5])->count();
        $totalOutbound = Asset::whereIn('category_statuses_id', [3])->count();
        $totalRepair = Asset::whereIn('category_statuses_id', [6])->count();
        $totalLost = Asset::whereIn('category_statuses_id', [7])->count();

        return view('layouts.welcome', compact(
            'totalAssets',
            'totalInbound',
            'totalOutbound',
            'totalRepair',
            'totalLost'
        ));
    }

    function staff()
    {
        $totalAssets = Asset::count();
        $totalInbound = Asset::whereIn('category_statuses_id', [1, 5])->count();
        $totalOutbound = Asset::whereIn('category_statuses_id', [3])->count();
        $totalRepair = Asset::whereIn('category_statuses_id', [6])->count();
        $totalLost = Asset::whereIn('category_statuses_id', [7])->count();

        return view('layouts.welcome', compact(
            'totalAssets',
            'totalInbound',
            'totalOutbound',
            'totalRepair',
            'totalLost'
        ));
    }

    function supervisor()
    {
        $totalAssets = Asset::count();
        $totalInbound = Asset::whereIn('category_statuses_id', [1, 5])->count();
        $totalOutbound = Asset::whereIn('category_statuses_id', [3])->count();
        $totalRepair = Asset::whereIn('category_statuses_id', [6])->count();
        $totalLost = Asset::whereIn('category_statuses_id', [7])->count();

        return view('layouts.welcome', compact(
            'totalAssets',
            'totalInbound',
            'totalOutbound',
            'totalRepair',
            'totalLost'
        ));
    }

    public function markAllAsRead(Request $request)
    {
        auth()->user()->unreadNotifications->each(function ($notification) {
            $notification->update(['title' => 'font-weight-normal']);
        });

        return response()->json(['message' => 'All notifications marked as read']);

        // auth()->user()->unreadNotifications->each(function ($notification) {
        //     $notification->update(['read_at' => now()]);
        // });

        // return response()->json(['message' => 'All notifications marked as read']);

    }

    function inbound()
    {
        $devices = Device::all();
        $racks = Rack::all();
        $softwares = Software::all();

        return view('layouts.inbound', [
            'devices' => $devices,
            'racks' => $racks,
            'softwares' => $softwares,
        ]);
    }

    function return()
    {
        $racks = Rack::all();
        $statuss = CategoryStatus::all();

        return view('layouts.return', [
            'racks' => $racks,
            'statuss' => $statuss,
        ]);
    }

    public function inventorys()
    {
        $assets = Asset::with(['device', 'software'])->whereIn('assets.category_statuses_id', [1, 5])->get();

        // Mengirim data ke view
        return view('layouts.inventorys', compact('assets'));
    }

    function assets()
    {
        // Mengambil data assets dengan relasi device dan category_statuses
        $assets = Asset::with(['device', 'categorystatus'])->get();

        // Mengambil data user
        $userRole = auth()->user()->role;

        return view('layouts.assets', compact('assets', 'userRole'));
    }

    function deleteAssets()
    {
        // Mengambil data assets dengan relasi device dan category_statuses
        $assets = Asset::with(['device', 'categorystatus', 'inbound'])->get();

        // Mengambil data user
        $userRole = auth()->user()->role;

        return view('layouts.deleteAsset', compact('assets', 'userRole'));
    }

    function editAssets($id)
    {
        $data = Asset::find($id);

        return view('layouts.editAsset', compact('data'));
    }

    public function editAsset(Request $request, $id)
    {
        $request->validate([
            'explanation' => 'required',
        ]);

        $data = Asset::find($id);

        $data->update([
            'explanation' => $request->explanation,
            'category_statuses_id' => 5,
        ]);

        // Sesuaikan parameter yang diperlukan saat membuat URL redirect
        return redirect()->route('asset.deleteView');
    }

    public function delete(Asset $asset)
    {
        try {
            // Pastikan kolom approval_status ada di model Asset
            if (!$asset->inbound && !$asset->outbound) {
                return redirect('/assets/delete')->with('error', 'Invalid asset data.');
            }

            // Cek kondisi sebelum melakukan penghapusan
            if ($asset->inbound && $asset->sto_number === null && ($asset->inbound->approval_status === 'Reject' || $asset->category_statuses_id == 7)) {
                $asset->delete();
                $asset->inbound->delete();
                return redirect('/assets/delete')->with('success', 'Asset deleted successfully!');
            } elseif ($asset->outbound && $asset->outbound->approval_status === 'Reject') {
                $asset->delete();
                $asset->outbound->delete();
                return redirect('/assets/delete')->with('success', 'Asset deleted successfully!');
            } else {
                // Tangani kondisi lain
                return redirect('/assets/delete')->with('error', 'Asset cannot be deleted due to specific conditions.');
            }
        } catch (QueryException $e) {
            // Tangani kesalahan lainnya
            return redirect('/assets/delete')->with('error', 'Error deleting the Asset.');
        }
    }

    function outbound(Request $request)
    {
        $assets = Asset::where('category_statuses_id', [1, 5])->get();
        $locations = Division::all();

        return view('layouts.outbounds', compact('locations', 'assets'));
    }

    function locations()
    {
        auth()->user()->unreadNotifications->where('id', request('id'))->first()?->update(['title' => 'font-weight-normal']);

        // Mengambil data Inlocation yang memiliki loc_number unik
        $inlocations = Inlocation::with(['outbound.division'])->get();
        $groupedInlocations = $inlocations->groupBy('loc_number');

        // Mengambil data user
        $userRole = auth()->user()->role;

        return view('layouts.locations', compact('userRole', 'groupedInlocations'));
    }

    function detailLocations($location)
    {
        $dataLoc = Inlocation::with(['outbound.division', 'outbound.asset'])->where('loc_number', $location)->first();
        $inlocation = Inlocation::with(['outbound.division', 'outbound.asset'])->where('loc_number', $location)->get();

        return view('layouts.detailLocation', compact('inlocation', 'dataLoc'));
    }

    function updateLocations($location)
    {
        $dataLoc = Inlocation::with(['outbound.division', 'outbound.asset'])->where('loc_number', $location)->first();
        $inlocation = Inlocation::with(['outbound.division', 'outbound.asset'])->where('loc_number', $location)->get();

        return view('layouts.updateLocation', compact('inlocation', 'dataLoc'));
    }

    function editLocations($location,$id)
    {
        $data = Outbound::find($id);
        $conditions = Condition::whereIn('id', [1, 2, 3])->get();
        $softwares = Software::all();

        return view('layouts.editLocation', compact('data', 'conditions', 'softwares'));
    }

    public function editLocation(Request $request, $location, $id)
    {
        $request->validate([
            'condition_id' => 'required',
        ]);

        $data = Outbound::find($id);
        $asset = Asset::where('sto_number', $data->sto_number)->first();

        $data->update([
            'conditions_id' => $request->condition_id,
            'pic' => $request->pic,
        ]);

        $asset->update([
            'explanation' => $request->explanation,
            'software_id' => $request->software_id
        ]);

        // Sesuaikan parameter yang diperlukan saat membuat URL redirect
        return redirect()->route('locations.detail', ['location' => $location]);
    }

    function detailInformation($location, $id)
    {
        $data = Document::find($id);

        return view('layouts.detailInformation', compact('data'));
    }

    function catalog()
    {
        $totalUsers = User::count();
        $totalDevices = Device::count();
        $totalLocations = Division::count();
        $totalRacks = Rack::count();
        $totalSoftwares = Software::count();

        return view('layouts.catalog', compact(
            'totalUsers',
            'totalDevices',
            'totalLocations',
            'totalRacks',
            'totalSoftwares'
        ));
    }

}
