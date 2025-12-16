<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WargaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 1000; $i++) {

            DB::table('warga')->insert([
                'no_ktp' => $faker->nik(), // faker Indonesia khusus nik
                'nama' => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']),
                'pekerjaan' => $faker->jobTitle(),
                'telp' => $faker->phoneNumber(),
                'email' => $faker->unique()->safeEmail(),
            ]);
        }
    }
}
