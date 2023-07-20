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
        //dosen
        $mulyono = User::create([
            'name' => 'Mulyono, S.Si., M.Si., Ph.D.',
            'email' => 'mulyono@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' => bcrypt('kajur'),
        ]); //1
        $hardoko = User::create([
            'name' => 'Dr. Hardoko Insan Qudus, M.S.',
            'email' => 'hardoko.insan@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $ilim = User::create([
            'name' => 'Dr. Dra. Ilim, M.S.',
            'email' => 'ilim_ds@yahoo.com.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
            'profile_picture' => 'dwi.jpg'
        ]);
        $buhani = User::create([
            'name' => 'Prof . Dr. Buhani, M.Si.',
            'email' => 'buhani_s@yahoo.co.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $suharso = User::create([
            'name' => 'Prof. Ir. Suharso, S.Si., Ph.D.',
            'email' => 'suharso@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $agung = User::create([
            'name' => 'Dr Agung Abadi Kiswandono, S.Si., M.Sc.',
            'email' => 'agungkiswandono@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $rinawati = User::create([
            'name' => 'Dr. Rinawati, Ph.D, S.Si, M.Si',
            'email' => 'rinawati@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
            'lokasi_id' => 1
        ]);
        $dian = User::create([
            'name' => 'Dr. Dian Herasari, M.Si.',
            'email' => 'dehayan@yahoo.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
            'lokasi_id' => 5
        ]);
        $heri = User::create([
            'name' => 'Dr. Eng. Heri Satria, S.Si., M.Si.',
            'email' => 'heri.satria@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $sonny = User::create([
            'name' => 'Dr. Sonny Widiarto, S.Si., M.Sc.',
            'email' => 'sonnywidiarto@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $mita = User::create([
            'name' => 'Dr. Mita Rilyanti, S.Si., M.Si.',
            'email' => 'mitarilyanti@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $kamisah = User::create([
            'name' => 'Prof. Dr. Kamisah Delilawati Pandiangan, S.Si., M.Si.',
            'email' => 'kamisah.delilawati@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
            'lokasi_id' => 2
        ]);
        $syaiful = User::create([
            'name' => 'Syaiful Bahri, S.Si, M.Si',
            'email' => 'muzaki2002@yahoo.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $noviany = User::create([
            'name' => 'Prof. Noviany, S.Si., M.Si, Ph.D',
            'email' => 'noviany@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
            'lokasi_id' => 3
        ]);
        $diky = User::create([
            'name' => 'Diky Hidayat, S.Si., M.Sc.',
            'email' => 'dikyhidayat93@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $suripto = User::create([
            'name' => 'Dr. Eng. Suripto Dwi Yuwono, S.Si., M.T.',
            'email' => 'suripto.dwi@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $yuli = User::create([
            'name' => 'Dr. Yuli Ambarwati, S.Si, M.Si.',
            'email' => 'yuliambar74@yahoo.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $nurhasanah = User::create([
            'name' => 'Dr. Nurhasanah, S.Si, M.Si',
            'email' => 'nur.hasanah@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $gede = User::create([
            'name' => 'Dr. Ni Luh Gede Ratna Juliasih, S.Si., M.Si.',
            'email' => 'ratnagede.juliasih@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
            'lokasi_id' => 4
        ]);
        $pratama = User::create([
            'name' => 'Dian Septiani Pratama, S.Si., M.Si.',
            'email' => 'pratama.dian@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $devi = User::create([
            'name' => 'Devi Nur Anisa, S.Pd., M.Sc',
            'email' => 'devinur@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $hapin = User::create([
            'name' => 'Hapin Afriyani, S.Si., M.Si.',
            'email' => 'hapin.afriyani@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);

        $yandri = User::create([
            'name' => 'Prof. Dr., Ir. Yandri A.S., M.S.',
            'email' => 'yandri.as@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $tati = User::create([
            'name' => 'Prof. Dr. Tati Suhartati, M.S.',
            'email' => 'tati.suhartati@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $wasinton = User::create([
            'name' => 'Prof. Wasinton Simanjuntak, M.Sc., Ph.D.',
            'email' => 'wasinton.simanjuntak@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $mangapul = User::create([
            'name' => 'Prof. Rudy T. Mangapul Situmeang, M.Sc., Ph.D.',
            'email' => 'rudy.tahan@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $pranoto = User::create([
            'name' => 'Dr. Ir. Adi Pranoto, M.Sc.',
            'email' => 'neobyu10@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $john = User::create([
            'name' => 'Prof. Drs. John Hendri,, M.S., Ph.D.',
            'email' => 'john.hendri@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $andi = User::create([
            'name' => 'Prof. Andi Setiawan, M.Sc., Ph.D',
            'email' => 'andi.setiawan@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $aspita = User::create([
            'name' => 'Dra. Aspita Laila, M.S.',
            'email' => 'aspita.laila@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $zipora = User::create([
            'name' => 'Dr. Zipora Sembiring, M.Si, Dra.',
            'email' => 'zipora.sembiring@fmipa.unila.ac.id',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        //end dosen
        //sudo
        $sudo = User::create([
            'name' => 'SUPER USER ADMIN DO',
            'email' => 'sudo@sudo.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        
        //endsudo
        //admin berkas
        $adminBerkas = User::create([
            'name' => 'Rudi Santoso',
            'email' => 'rd.santoso181@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]); //32
        //end admin berkas
        //admin lab
        $analitik = User::create([
            'name' => 'Fakhruddin, S.T',
            'email' => 'fakhruddin1006@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
            'lokasi_id' => 1
        ]); //33
        $anorganik = User::create([
            'name' => 'Liza Apriliya Sukartiningsih, S.Si.',
            'email' => 'lizaapriliya15@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
            'lokasi_id' => 2
        ]); //34
        $organik = User::create([
            'name' => 'Wiwit Kasmawati',
            'email' => 'wiwitkasmawati02@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
            'lokasi_id' => 3
        ]); //35
        $biokimia = User::create([
            'name' => 'Della Rahmadhani Putri',
            'email' => 'dellarahmadhaniputri@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
            'lokasi_id' => 4
        ]); //36
        $kidas = User::create([
            'name' => 'Tri Kismwantari, A.Md.',
            'email' => 'trikiswantari@gmail.comg',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
            'lokasi_id' => 5
        ]); //37
        //endadminlab

        $mhs = User::create([
            'name' => 'Egon Otmar',
            'email' => 'omar.students@mail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
            'profile_picture' => 'man.jpg'
        ]);
        $mhs2 = User::create([
            'name' => 'Melati Aminah',
            'email' => 'melatiaminah.students@mail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
            'profile_picture' => 'woman.jpg'
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


        $mhs5 = User::create([
            'name' => 'Elvina Pratiwi',
            'email' => 'vera.hastutigmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $mhs6 = User::create([
            'name' => 'Enteng Waluyo',
            'email' => 'entengwaluyo10@mail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $mhs7 = User::create([
            'name' => 'Nilam Palastri',
            'email' => 'nilampalastri1010@mail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('kajur'),
        ]);
        $mhs8 = User::create([
            'name' => 'Cakrajiya Anggriawan',
            'email' => 'cakrajiya@mail.com',
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
        $sudo->assignRole('sudo');
        $mulyono->assignRole(['dosen', 'jurusan']);
        $aspita->assignRole(['dosen', 'pkl']);
        $ilim->assignRole(['dosen', 'ta1']);
        $devi->assignRole(['dosen', 'ta1']);
        $syaiful->assignRole(['dosen', 'ta2']);
        $mita->assignRole(['dosen', 'kompre']);
        $gede->assignRole(['dosen', 'ta2', 'kalab']);
        $rinawati->assignRole(['dosen', 'kalab']);
        $kamisah->assignRole(['dosen', 'kalab']);
        $noviany->assignRole(['dosen', 'kalab']);
        $dian->assignRole(['dosen', 'kalab']);
        $pranoto->assignRole([ 'jurusan', 'sudo']);
        $hardoko->assignRole('dosen');
        $buhani->assignRole('dosen');
        $suharso->assignRole('dosen');
        $agung->assignRole('dosen');
        $heri->assignRole('dosen');
        $sonny->assignRole('dosen');
        $diky->assignRole('dosen');
        $suripto->assignRole('dosen');
        $yuli->assignRole('dosen');
        $nurhasanah->assignRole('dosen');
        $pratama->assignRole('dosen');
        $hapin->assignRole('dosen');
        $yandri->assignRole('dosen');
        $tati->assignRole('dosen');
        $wasinton->assignRole('dosen');
        $mangapul->assignRole('dosen');
        $john->assignRole('dosen');
        $andi->assignRole('dosen');
        $zipora->assignRole('dosen');

        //admin berkas
        $adminBerkas->assignRole('admin berkas');
        //end admin berkas
        //admin lab
        $analitik->assignRole('admin lab');
        $anorganik->assignRole('admin lab');
        $organik->assignRole('admin lab');
        $biokimia->assignRole('admin lab');
        $kidas->assignRole('admin lab');
        //end adminlab
        //mahasiswa
        $mhs->assignRole(['mahasiswa', 'alumni']);
        $mhs2->assignRole(['mahasiswa', 'alumni']);
        $mhs3->assignRole(['mahasiswa', 'alumni']);
        $mhs4->assignRole(['mahasiswa', 'alumni']);
        $mhs5->assignRole('mahasiswa');
        $mhs6->assignRole('mahasiswa');
        $mhs7->assignRole('mahasiswa');
        $mhs8->assignRole('mahasiswa');
        //end mahasiswa
    }
}
