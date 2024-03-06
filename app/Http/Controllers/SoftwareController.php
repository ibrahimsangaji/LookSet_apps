<?php

namespace App\Http\Controllers;

use App\Models\Software;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    public function index()
    {
        $softwares = Software::all();

        return view('catalog.software', ['softwares' => $softwares]);
    }

    public function create()
    {
        return view('create.createSoftware');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'information' => 'required|string|max:255',
        ]);

        $existingSoftware = Software::where('name', $validatedData['name'])->first();

        if ($existingSoftware) {
            return redirect('/catalog/software')->with('error', 'Software with the same name already exists!');
        }

        Software::create($validatedData);

        return redirect('/catalog/software')->with('success', 'Software added successfully!');
    }

    public function edit(Software $software)
    {
        return view('edit.editSoftware', ['software' => $software]);
    }

    public function update(Request $request, Software $software)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'.$software->id,
            'information' => 'nullable|string|max:255',
        ]);

        $software->update($validatedData);

        return redirect()->route('software.index')->with('success', 'Software updated successfully!');
    }

    public function destroy(Software $software)
    {
        try {
            $software->delete();
            return redirect('/catalog/software')->with('success', 'Software deleted successfully!');
        } catch (QueryException $e) {
            // Menggunakan kode SQLSTATE[23000] untuk mendeteksi kesalahan referensi kunci asing
            if ($e->getCode() == '23000') {
                return redirect('/catalog/software')->with('error', 'Cannot remove the Software. Because the Software is still in use.');
            } else {
                // Tangani kesalahan lainnya
                return redirect('/catalog/software')->with('error', 'Error deleting the Software.');
            }
        }
    }
}
