<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Persil;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['jenis_kelamin'];
        $searchableColumns = ['agama'];
        $data['warga'] = Warga::filter($request, $filterableColumns)
        ->search($request, $searchableColumns)
        ->paginate(9)->withQueryString();
        return view('pages.warga.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['warga'] = Warga::all();

        return view('pages.warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
             'telp' => 'required',
            'email' => 'required',
        ]);

        Warga::create($validated);
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['warga'] = Warga::findOrFail($id);
         $data['persil'] = Persil::all();
        return view('pages.warga.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $warga = Warga::findOrFail($id);
        $validated = $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required',
            'email' => 'required',
        ]);


        $warga->update($validated);
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Warga::findOrFail($id)->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga dihapus!');
    }
}
