<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persil;
use App\Models\Sengketa;
use App\Models\Media;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class SengketaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $persils = Persil::all();
        $sampleFiles = Storage::files('public/sample');

        // Kalimat Bahasa Indonesia
        $kronologiList = [
            'Terjadi sengketa kepemilikan tanah antara dua pihak yang mengklaim hak atas persil tersebut.',
            'Permasalahan bermula ketika salah satu pihak mengajukan klaim kepemilikan tanpa dokumen yang lengkap.',
            'Sengketa ini muncul akibat perbedaan data sertifikat dan batas tanah.',
            'Kedua belah pihak tidak mencapai kesepakatan sehingga perkara dilanjutkan ke proses hukum.',
            'Terjadi konflik akibat jual beli tanah yang tidak disertai akta resmi.'
        ];

        $penyelesaianList = [
            'Sengketa diselesaikan melalui musyawarah dan kesepakatan bersama.',
            'Perkara diselesaikan melalui keputusan pengadilan negeri.',
            'Dilakukan mediasi oleh pihak kelurahan setempat.',
            'Salah satu pihak mengalah setelah verifikasi dokumen.',
            'Disepakati pembagian lahan sesuai hasil pengukuran ulang.'
        ];

        foreach ($persils as $persil) {
            for ($i = 0; $i < 2; $i++) {

                $status = $faker->randomElement(['Proses', 'Selesai']);

                $sengketa = Sengketa::create([
                    'persil_id'     => $persil->persil_id,
                    'pihak_1'       => $faker->name, // Nama Indonesia
                    'pihak_2'       => $faker->name,
                    'kronologi'    => $faker->randomElement($kronologiList),
                    'status'        => $status,
                    'penyelesaian' => $status === 'Selesai'
                        ? $faker->randomElement($penyelesaianList)
                        : null,
                ]);

                // Upload 1–3 media
                if (!empty($sampleFiles)) {
                    $countMedia = rand(1, min(3, count($sampleFiles)));
                    $mediaSamples = $faker->randomElements($sampleFiles, $countMedia);

                    foreach ($mediaSamples as $file) {
                        Media::create([
                            'ref_table' => 'sengketa',
                            'ref_id'    => $sengketa->sengketa_id,
                            'file_name' => basename($file),
                            'mime_type' => 'image/jpeg',
                        ]);
                    }
                }
            }
        }
    }
}
