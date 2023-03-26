<?php

namespace Database\Seeders;

use App\Models\Klinik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KlinikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Klinik::create([
            'nama_klinik' => 'Klinik Citra',
            'alamat_klinik' => 'Danau Ranau',
            'kota' => 'Malang',
            'tlp_klinik' => '021 070707',
            'fax_klinik' => '021 07072207',
            'biaya_admin' => '30000',
        ]);
    }
}
