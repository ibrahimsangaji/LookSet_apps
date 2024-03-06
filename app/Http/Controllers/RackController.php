<?php

namespace App\Http\Controllers;

use App\Models\Rack;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RackController extends Controller
{
    public function index()
    {
        $racks = Rack::all();

        return view('catalog.rack', ['racks' => $racks]);
    }

    public function create()
    {
        return view('create.createRack');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'explanation' => 'required|string|max:255',
        ]);

        Rack::create($validatedData);

        return redirect('/catalog/rack')->with('success', 'Rack added successfully!');
    }

    public function edit(Rack $rack)
    {
        return view('edit.editRack', ['rack' => $rack]);
    }

    public function update(Request $request, Rack $rack)
    {
        $validatedData = $request->validate([
            'explanation' => 'required|string|max:255|unique:racks,explanation,' . $rack->id,
        ]);

        $existingRack = Rack::where('explanation', $validatedData['explanation'])->where('id', '!=', $rack->id)->first();

        if ($existingRack) {
            return redirect('/catalog/rack')->with('error', 'Rack with the same explanation already exists!');
        }

        $rack->update($validatedData);

        return redirect('/catalog/rack')->with('success', 'Rack updated successfully!');
    }

    public function destroy(Rack $rack)
    {

        try {
            $rack->delete();
            return redirect('/catalog/rack')->with('success', 'Rack deleted successfully!');
        } catch (QueryException $e) {
            // Menggunakan kode SQLSTATE[23000] untuk mendeteksi kesalahan referensi kunci asing
            if ($e->getCode() == '23000') {
                return redirect('/catalog/rack')->with('error', 'Cannot remove the Rack. Because the Rack is still in use.');
            } else {
                // Tangani kesalahan lainnya
                return redirect('/catalog/rack')->with('error', 'Error deleting the Rack.');
            }
        }
    }
}
