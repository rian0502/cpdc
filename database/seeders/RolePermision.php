<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RolePermision extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //buatkan seeder menggunakan spatie
        $user = User::create([
            'name' => 'Nathaniel Holmgren, S.T., M.T.',
            'email' => 'kajur.kimia@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('kajur'),
        ]);
        $adminLab = User::create([
            'name' => 'Fulan bin Fulan',
            'email' => 'admin.lab@mail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $adminBerkas = User::create([
            'name' => 'Rudi Santoso',
            'email' => 'admin.berkas@mail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $dosen1 = User::create([
            'name' => 'Benno Gustav, S.Si., M.Si.',
            'email' => 'dosen1@mail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $dosen2 = User::create([
            'name' => 'Dwi Lestari, S.Si., M.Si, Ph.D.',
            'email' => 'dosen2@mail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $mhs = User::create([
            'name' => 'Egon Otmar',
            'email' => 'omar.students@mail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $mhs2 = User::create([
            'name' => 'Melati Aminah',
            'email' => 'melatiaminah.students@mail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $mhs3 = User::create([
            'name' => 'Wera Adamska',
            'email' => 'WeraAdamska@mail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $mhs4 = User::create([
            'name' => 'Gianni Ricci',
            'email' => 'GianniRicci@mail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $sudo1 = User::create([
            'name' => 'Sudo 1',
            'email' => 'sudo1@sudo.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $dosenKorKp = User::create([
            'name' => 'Lucas Duhamel S.Si., M.Si.',
            'email' => 'lucas.dosen@mail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $dosenKorTa1 = User::create([
            'name' => 'Savanna Hemelaar, S.T., M.T.',
            'email' => 'savannahemelaar.dosen@mail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $dosenKorTa2 = User::create([
            'name' => 'Dr. Monika Reiniger, S.Si., M.Si.',
            'email' => 'monikareiniger.dosen@mail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $dosenKorTa3 = User::create([
            'name' => 'Prof. Dr. Richard D. Harris, S.Si., M.Si., Ph.D.',
            'email' => 'richardDHarris.dosen@mail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $adminBerkas2 = User::create([
            'name' => 'Endang Sri Lestari',
            'email' => 'admin2.berkas@mail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);

        $roles = ['admin lab', 'admin berkas', 'mahasiswa', 'dosen', 'pkl', 'kompre', 'ta1', 'ta2', 'jurusan', 'alumni', 'kalab', 'sudo'];
        foreach ($roles as $role) {
            $role = Role::create([
                'name' => $role,
                'guard_name' => 'web'
            ]);
        }
        $user->assignRole(['jurusan', 'dosen']);
        $dosen1->assignRole(['dosen', 'kalab']);
        $dosen2->assignRole('dosen');
        $adminLab->assignRole('admin lab');
        $adminBerkas->assignRole('admin berkas');
        $adminBerkas2->assignRole('admin berkas');
        $sudo1->assignRole('sudo');
        $mhs->assignRole('mahasiswa');
        $mhs2->assignRole('mahasiswa');
        $mhs3->assignRole('mahasiswa');
        $mhs4->assignRole('mahasiswa');
        $dosenKorKp->assignRole(['dosen', 'pkl']);
        $dosenKorTa1->assignRole(['dosen', 'ta1']);
        $dosenKorTa2->assignRole(['dosen', 'ta2']);
        $dosenKorTa3->assignRole(['dosen', 'kompre']);
    }
}
