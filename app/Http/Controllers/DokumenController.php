<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Persil;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['jenis_dokumen'];
        $searchableColumns = ['nomor', 'keterangan'];

        $data = Dokumen::with('persil', 'media')
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->latest() // 🔥 paling baru dulu
            ->paginate(9)
            ->withQueryString();

        return view('pages.dokumen.index', compact('data'));
    }


    public function create()
    {
        $persil = Persil::all();
        return view('pages.dokumen.create', compact('persil'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'persil_id' => 'required|exists:persil,persil_id',
            'jenis_dokumen' => 'required|string',
            'nomor' => 'required|unique:dokumen,nomor',
            'keterangan' => 'nullable|string',
            'media_files.*' => 'file|mimes:jpeg,png,jpg,gif,pdf|max:30720'
        ]);

        // simpan dokumen
        $dokumen = Dokumen::create($request->only(
            'persil_id',
            'jenis_dokumen',
            'nomor',
            'keterangan'
        ));

        // MULTIPLE MEDIA UPLOAD
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $i => $file) {

                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('uploads/dokumen', $filename, 'public');

                Media::create([
                    'ref_table' => 'dokumen',
                    'ref_id' => $dokumen->dokumen_id,
                    'file_name' => $filename,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('dokumen.index')
            ->with('success', 'Data dokumen berhasil disimpan!');
    }



    public function edit($id)
    {
        $dokumen = Dokumen::with('media')->findOrFail($id);
        $persil = Persil::all();

        return view('pages.dokumen.edit', compact('dokumen', 'persil'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'persil_id' => 'required|exists:persil,persil_id',
            'jenis_dokumen' => 'required|string',
            'nomor' => "required|unique:dokumen,nomor,$id,dokumen_id",
            'keterangan' => 'nullable|string',
            'media_files.*' => 'file|mimes:jpeg,png,jpg,gif,pdf|max:4096'
        ]);

        $dokumen = Dokumen::findOrFail($id);

        // update data utama
        $dokumen->update($request->only(
            'persil_id',
            'jenis_dokumen',
            'nomor',
            'keterangan'
        ));

        // urutan terakhir
        $lastSort = Media::where('ref_table', 'dokumen')
            ->where('ref_id', $dokumen->dokumen_id)
            ->max('sort_order') ?? 0;

        // upload media baru
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $i => $file) {

                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('uploads/dokumen', $filename, 'public');

                Media::create([
                    'ref_table' => 'dokumen',
                    'ref_id' => $dokumen->dokumen_id,
                    'file_name' => $filename,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $lastSort + $i + 1, // 🔥 lanjut urutan lama
                ]);
            }
        }

        return redirect()->route('dokumen.index')
            ->with('success', 'Data dokumen berhasil diperbarui!');
    }

    // DokumenController.php (Contoh)
    public function show($id)
    {
        $dokumen = Dokumen::with('media', 'persil')->findOrFail($id);
        return response()->json($dokumen);
    }

    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        // hapus semua media terkait
        foreach ($dokumen->media as $media) {
            Storage::disk('public')->delete('uploads/dokumen/' . $media->file_name);
            $media->delete();
        }

        $dokumen->delete();

        return back()->with('success', 'Data dokumen berhasil dihapus!');
    }

    public function deleteMedia($media_id)
    {
        $media = Media::findOrFail($media_id);

        // Path file sesuai storage disk 'public'
        $filePath = storage_path('app/public/uploads/dokumen/' . $media->file_name);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $media->delete();

        // Response JSON untuk AJAX
        return response()->json(['success' => true]);
    }
}
