<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Division::all();

        return view('catalog.location', ['locations' => $locations]);
    }

    public function create()
    {
        return view('create.createLocation');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'information' => 'nullable|string|max:255',
        ]);

        $existingLocation = Division::where('name', $validatedData['name'])->first();

        if ($existingLocation) {
            return redirect('/catalog/location')->with('error', 'Location with the same name already exists!');
        }

        Division::create($validatedData);

        return redirect('/catalog/location')->with('success', 'Location added successfully!');
    }

    public function edit(Division $location)
    {
        return view('edit.editLocation', ['location' => $location]);
    }

    public function update(Request $request, Division $location)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'.$location->id,
            'information' => 'nullable|string|max:255',
        ]);

        $location->update($validatedData);

        return redirect('/catalog/location')->with('success', 'Location updated successfully!');
    }

    public function destroy(Division $location)
    {
        try {
            $location->delete();
            return redirect('/catalog/location')->with('success', 'Location deleted successfully!');
        } catch (QueryException $e) {
            // Menggunakan kode SQLSTATE[23000] untuk mendeteksi kesalahan referensi kunci asing
            if ($e->getCode() == '23000') {
                return redirect('/catalog/device')->with('error', 'Cannot remove the device. Because the device is still in use.');
            } else {
                // Tangani kesalahan lainnya
                return redirect('/catalog/device')->with('error', 'Error deleting the device.');
            }
        }
        $location->delete();
        return redirect('/catalog/location')->with('success', 'Location deleted successfully!');
    }
}
