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

        //endadminlab

        $roles = ['admin lab', 'admin berkas', 'mahasiswa', 'dosen', 'pkl', 'kompre', 'ta1', 'ta2',
        'jurusan', 'alumni', 'kalab', 'sudo', 'kaprodiS1', 'kaprodiS2', 'ta1S2', 'ta2S2', 'kompreS2', 'mahasiswaS2', 'alumniS2', 'tpmpsS1', 'tpmsS2'
    ];
        foreach ($roles as $role) {
            $role = Role::create([
                'name' => $role,
                'guard_name' => 'web'
            ]);
        }

    }
}
