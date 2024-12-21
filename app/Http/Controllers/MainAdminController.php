<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Katalog;

class MainAdminController extends Controller
{
    public function index()
    {
        return view('admin.page.index');
    }

    public function loginindex()
    {
        return view('admin.auth.login');
    }

    public function katalogAdmin()
    {
        $katalogs = Katalog::all();

        return view('admin.page.katalog', compact('katalogs'));

    }

    public function storeKatalogAdmin(Request $request)
    {
        $request->validate([
            'nama_katalog' => 'required|string|max:255',
            'harga_katalog' => 'required|string|max:255',
            'deskripsi_katalog' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/katalog'), $imageName);

        Katalog::create([
            'nama_katalog' => $request->nama_katalog,
            'harga_katalog' => $request->harga_katalog,
            'deskripsi_katalog' => $request->deskripsi_katalog,
            'image' => 'images/katalog/'.$imageName,
        ]);

        return redirect()->back()->with('success', 'Katalog berhasil ditambahkan!');
    }

    public function editKatalogAdmin($id)
    {
        $katalog = Katalog::findOrFail($id);
        return response()->json($katalog);
    }

    public function updateKatalog(Request $request, $id)
    {
        $request->validate([
            'nama_katalog' => 'required|string|max:255',
            'harga_katalog' => 'required|string|max:255',
            'deskripsi_katalog' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $katalog = Katalog::findOrFail($id);
        $katalog->nama_katalog = $request->nama_katalog;
        $katalog->harga_katalog = $request->harga_katalog;
        $katalog->deskripsi_katalog = $request->deskripsi_katalog;

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if (file_exists(public_path($katalog->image))) {
                unlink(public_path($katalog->image));
            }

            // Upload gambar baru
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/katalog'), $imageName);
            $katalog->image = 'images/katalog/' . $imageName;
        }

        $katalog->save();

        return redirect()->route('katalogAdmin')->with('success', 'Katalog berhasil diperbarui.');
    }


    // Controller Method for Delete
    public function deleteKatalogAdmin($id)
    {
        $katalog = Katalog::findOrFail($id);
        $katalog->delete();

        return redirect()->back()->with('success', 'Katalog berhasil dihapus!');
    }



}
