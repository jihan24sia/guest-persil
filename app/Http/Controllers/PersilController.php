<?php

namespace App\Http\Controllers;

use App\Models\Persil;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;

class PersilController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['rt', 'rw'];
        $searchableColumns = ['penggunaan'];

        $persil = Persil::with('media')
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->latest() // 🎯 ini yang bikin data terbaru tampil dulu
            ->paginate(9)
            ->withQueryString();

        $persilIDs = $persil->pluck('persil_id');

        return view('pages.persil.index', compact('persil', 'persilIDs'));
    }


    public function create()
    {
        $warga = Warga::all();
        return view('pages.persil.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_persil'      => 'required|unique:persil,kode_persil',
            'pemilik_warga_id' => 'required',
            'luas_m2'          => 'required|numeric',
            'penggunaan'       => 'required',
            'alamat_lahan'     => 'required',
            'rt'               => 'required',
            'rw'               => 'required',
            'media_files.*'    => 'nullable|image|max:30720',
        ]);

        // CREATE PERSIL
        $persil = Persil::create($request->only(
            'kode_persil',
            'pemilik_warga_id',
            'luas_m2',
            'penggunaan',
            'alamat_lahan',
            'rt',
            'rw'
        ));

        // MULTIPLE UPLOAD
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $i => $file) {

                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('uploads/persil', $filename, 'public');

                Media::create([
                    'ref_table' => 'persil',
                    'ref_id'    => $persil->persil_id,
                    'file_name' => $filename,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('persil.index')
            ->with('success', 'Data persil berhasil disimpan!');
    }

    public function edit($id)
    {
        $persil = Persil::with('media')->findOrFail($id);
        $warga  = Warga::all();

        return view('pages.persil.edit', compact('persil', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_persil'      => 'required|unique:persil,kode_persil,' . $id . ',persil_id',
            'pemilik_warga_id' => 'required',
            'luas_m2'          => 'required|numeric',
            'penggunaan'       => 'required',
            'alamat_lahan'     => 'required',
            'rt'               => 'required',
            'rw'               => 'required',
            'media_files.*'    => 'nullable|image|max:2048',
        ]);

        $persil = Persil::findOrFail($id);

        $persil->update($request->only(
            'kode_persil',
            'pemilik_warga_id',
            'luas_m2',
            'penggunaan',
            'alamat_lahan',
            'rt',
            'rw'
        ));

        // TAMBAH GAMBAR BARU (LAMA TIDAK DIHAPUS)
        if ($request->hasFile('media_files')) {

            // ambil urutan terakhir
            $lastSort = Media::where('ref_table', 'persil')
                ->where('ref_id', $persil->persil_id)
                ->max('sort_order') ?? 0;

            foreach ($request->file('media_files') as $i => $file) {

                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('uploads/persil', $filename, 'public');

                Media::create([
                    'ref_table' => 'persil',
                    'ref_id'    => $persil->persil_id,
                    'file_name' => $filename,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $lastSort + $i + 1,
                ]);
            }
        }

        return redirect()->route('persil.index')
            ->with('success', 'Data persil berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Persil::findOrFail($id)->delete();

        $medias = Media::where('ref_table', 'persil')
            ->where('ref_id', $id)
            ->get();

        foreach ($medias as $media) {
            $path = public_path('uploads/persil/' . $media->file_name);
            if (file_exists($path)) unlink($path);
            $media->delete();
        }

        return redirect()->route('persil.index')
            ->with('success', 'Data persil dihapus!');
    }

    public function deleteMedia($media_id)
    {
        $media = Media::findOrFail($media_id);

        $path = public_path('uploads/persil/' . $media->file_name);
        if (file_exists($path)) unlink($path);

        $media->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
