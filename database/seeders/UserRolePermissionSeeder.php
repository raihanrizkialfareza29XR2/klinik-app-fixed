<?php

namespace Database\Seeders;

use App\Models\Poli;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $defval = [
            'email_verified_at' => now(),
            'password' => bcrypt('klinikapp'), // password
            'remember_token' => Str::random(10),
        ];

        $userdokter = User::create(array_merge([
            'email' => 'dokter@gmail.com',
            'nama' => 'Dokter',
            'spesialis' => 'Bedah Saraf',
            'id_poli' => 1,
            'biaya_dokter' => 120000,
        ], $defval));
        $useradmin = User::create(array_merge([
            'email' => 'admin@gmail.com',
            'nama' => 'Admin',
        ], $defval));
        $userkasir = User::create(array_merge([
            'email' => 'kasir@gmail.com',
            'nama' => 'Kasir',
        ], $defval));
        $userapoteker = User::create(array_merge([
            'email' => 'apoteker@gmail.com',
            'nama' => 'Apoteker',
        ], $defval));
        $poli = Poli::create([
            'nama_poli' => 'Bedah Saraf',
        ]);


        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'dokter']);
        $role = Role::create(['name' => 'apoteker']);
        $role = Role::create(['name' => 'kasir']);

        $permission = Permission::create(['name' => 'admin_stuff']);
        $permission = Permission::create(['name' => 'dokter_stuff']);
        $permission = Permission::create(['name' => 'apoteker_stuff']);
        $permission = Permission::create(['name' => 'kasir_stuff']);

        $admin = Role::findByName('admin');
        $dokter = Role::findByName('dokter');
        $kasir = Role::findByName('kasir');
        $apoteker = Role::findByName('apoteker');

        $dokter->givePermissionTo('dokter_stuff');
        $admin->givePermissionTo('admin_stuff');
        $apoteker->givePermissionTo('apoteker_stuff');
        $kasir->givePermissionTo('kasir_stuff');

        $useradmin->assignRole('admin');
        $userdokter->assignRole('dokter');
        $userkasir->assignRole('kasir');
        $userapoteker->assignRole('apoteker');
    }
}
