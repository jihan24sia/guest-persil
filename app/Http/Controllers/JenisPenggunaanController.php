<?php

namespace App\Http\Controllers;

use App\Models\JenisPenggunaan;
use Illuminate\Http\Request;

class JenisPenggunaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['status'];
        $searchableColumns = ['nama_penggunaan'];

        $jenis = JenisPenggunaan::query()
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('pages.jenis.index', compact('jenis'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.jenis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_penggunaan' => 'required|unique:jenis_penggunaan,nama_penggunaan',
            'keterangan' => 'nullable|string',
        ]);

        JenisPenggunaan::create($request->all());

        return redirect()->route('jenis.index')->with('success', 'Jenis Penggunaan berhasil ditambahkan.');
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
        $jenis = JenisPenggunaan::findOrFail($id);
        return view('pages.jenis.edit', compact('jenis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jenis = JenisPenggunaan::findOrFail($id);

        $request->validate([
            'nama_penggunaan' => 'required|unique:jenis_penggunaan,nama_penggunaan,' . $id . ',jenis_id',
            'keterangan' => 'nullable|string',
        ]);

        $jenis->update($request->all());

        return redirect()->route('jenis.index')->with('success', 'Jenis Penggunaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        JenisPenggunaan::findOrFail($id)->delete();

        return redirect()->route('jenis.index')->with('success', 'Jenis Penggunaan berhasil dihapus.');
    }
}
