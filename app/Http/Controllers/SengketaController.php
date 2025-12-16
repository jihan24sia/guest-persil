<?php

namespace App\Http\Controllers;

use App\Models\Sengketa;
use App\Models\Persil;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SengketaController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['status'];
        $searchableColumns = ['kronologi'];

        $sengketa = Sengketa::with(['persil', 'media'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('pages.sengketa.index', compact('sengketa'));
    }

    public function create()
    {
        $persil = Persil::all();
        return view('pages.sengketa.create', compact('persil'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'persil_id' => 'required|exists:persil,persil_id',
            'pihak_1' => 'required|string',
            'pihak_2' => 'required|string',
            'kronologi' => 'required|string',
            'status' => 'required|string',
            'penyelesaian' => 'nullable|string',
            'media_files.*' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        $sengketa = Sengketa::create($validated);

        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $i => $file) { // Tambahkan $i untuk sort_order awal
                // Perubahan: Gunakan uniqid() dan getClientOriginalExtension() untuk nama file yang lebih unik
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                // Perubahan: Gunakan disk 'public' sebagai parameter ketiga
                $file->storeAs('uploads/sengketa', $filename, 'public');

                Media::create([
                    'ref_table' => 'sengketa',
                    'ref_id' => $sengketa->sengketa_id,
                    'file_name' => $filename,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $i, // Tambahkan sort_order
                ]);
            }
        }

        return redirect()->route('sengketa.index')->with('success', 'Sengketa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $sengketa = Sengketa::with('media')->findOrFail($id);
        $persil = Persil::all();
        return view('pages.sengketa.edit', compact('sengketa', 'persil'));
    }

    public function update(Request $request, $id)
    {
        $sengketa = Sengketa::findOrFail($id);

        // Pindahkan validasi ke atas
        $validated = $request->validate([
            'persil_id' => 'required|exists:persil,persil_id',
            'pihak_1' => 'required|string',
            'pihak_2' => 'required|string',
            'kronologi' => 'required|string',
            'status' => 'required|string',
            'penyelesaian' => 'nullable|string',
            'media_files.*' => 'nullable|file|mimes:jpg,jpeg,png|max:30720',
        ]);

        $sengketa->update($validated); // Lakukan update data non-media

        // Logika upload media BARU (Menambahkan ke yang sudah ada)
        if ($request->hasFile('media_files')) {
            // Ambil urutan terakhir dari media yang sudah ada
            $lastSort = Media::where('ref_table', 'sengketa')
                ->where('ref_id', $sengketa->sengketa_id)
                ->max('sort_order') ?? 0;

            foreach ($request->file('media_files') as $i => $file) {
                // Perubahan: Gunakan uniqid() dan getClientOriginalExtension() untuk nama file yang lebih unik
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                // Perubahan: Gunakan disk 'public' sebagai parameter ketiga
                $file->storeAs('uploads/sengketa', $filename, 'public');

                Media::create([
                    'ref_table' => 'sengketa',
                    'ref_id' => $sengketa->sengketa_id,
                    'file_name' => $filename,
                    'mime_type' => $file->getMimeType(),
                    // Perubahan: Urutan dimulai dari $lastSort + $i + 1
                    'sort_order' => $lastSort + $i + 1,
                ]);
            }
        }
        // Catatan: Logika upload media lama Anda di atas sudah dihapus.

        return redirect()->route('sengketa.index')->with('success', 'Sengketa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $sengketa = Sengketa::findOrFail($id);
        // Hapus media
        foreach ($sengketa->media as $m) {
            Storage::delete('public/uploads/sengketa/' . $m->file_name);
            $m->delete();
        }
        $sengketa->delete();
        return back()->with('success', 'Sengketa berhasil dihapus!');
    }

    public function deleteMedia($media_id)
    {
        $media = Media::findOrFail($media_id);

        $path = public_path('uploads/sengketa/' . $media->file_name);
        if (file_exists($path)) unlink($path);

        $media->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
