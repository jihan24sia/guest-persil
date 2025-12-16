<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Warga;
use App\Models\Persil;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;


class PersilSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $sampleFiles = Storage::files('public/sample'); // pastikan ada file contoh

        // Contoh penggunaan lahan
        $penggunaanList = ['Rumah Tinggal', 'Gudang', 'Toko', 'Kantor', 'Kebun', 'Tanah Kosong'];

        // Ambil semua warga (buat relasi)
        $wargaIds = Warga::pluck('warga_id')->toArray();

        for ($i = 1; $i <= 1000; $i++) {

            $persil = Persil::create([
                'pemilik_warga_id' => $faker->randomElement($wargaIds),
                'kode_persil'      => 'PRS-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'luas_m2'          => $faker->randomFloat(1, 80, 300),
                'penggunaan'       => $faker->randomElement($penggunaanList),
                'alamat_lahan'     => $faker->streetAddress(),
                'rt'               => str_pad($faker->numberBetween(1, 10), 2, '0', STR_PAD_LEFT),
                'rw'               => str_pad($faker->numberBetween(1, 10), 2, '0', STR_PAD_LEFT),
            ]);
        }
        $countMedia = min(rand(1, 3), count($sampleFiles)); // aman jika file sample kosong
        $mediaSamples = $faker->randomElements($sampleFiles, $countMedia);

        foreach ($mediaSamples as $file) {
            $filename = basename($file);
            Media::create([
                'ref_table' => 'persil',
                'ref_id' => $persil->persil_id,
                'file_name' => $filename,
                'mime_type' => 'image/jpeg',
            ]);
        }
    }
}
