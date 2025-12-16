<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peta;
use App\Models\Persil;
use App\Models\Media;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class PetaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $persils = Persil::all();
        $sampleFiles = Storage::files('public/sample'); // pastikan ada file contoh

        foreach ($persils as $persil) {
            for ($i = 0; $i < 3; $i++) {
                $peta = Peta::create([
                    'persil_id' => $persil->persil_id,
                    'geojson'   => json_encode([
                        'type' => 'Point',
                        'coordinates' => [$faker->longitude, $faker->latitude]
                    ]),
                    'panjang_m' => $faker->numberBetween(10, 100),
                    'lebar_m'   => $faker->numberBetween(10, 100),
                ]);

                // upload 1-3 media random
                $countMedia = min(rand(1, 3), count($sampleFiles)); // aman jika file sample kosong
                $mediaSamples = $faker->randomElements($sampleFiles, $countMedia);

                foreach ($mediaSamples as $file) {
                    $filename = basename($file);
                    Media::create([
                        'ref_table' => 'peta',
                        'ref_id' => $peta->peta_id,
                        'file_name' => $filename,
                        'mime_type' => 'image/jpeg',
                    ]);
                }
            }
        }
    }
}
