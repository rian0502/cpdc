<?php

namespace Database\Factories;
use App\Models\ModelKinerjaDosen;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModelKinerjaDosenFactory extends Factory
{
    protected $model = ModelKinerjaDosen::class;

    public function definition()
    {
        $tahun_akademik = $this->faker->numberBetween(2010, 2024);
        $tahun_akademik = $tahun_akademik . '/' . ($tahun_akademik + 1);
        $semester = $this->faker->randomElement(['Ganjil', 'Genap']);
        $dosen_id = $this->faker->numberBetween(1, 32);

        return [
            'encrypted_id' => $this->faker->sentence(3),
            'semester' => $semester,
            'tahun_akademik' => $tahun_akademik,
            'sks_pendidikan' => $this->faker->numberBetween(1, 100),
            'sks_penelitian' => $this->faker->numberBetween(1, 100),
            'sks_pengabdian' => $this->faker->numberBetween(1, 100),
            'sks_penunjang' => $this->faker->numberBetween(1, 100),
            'dosen_id' => $dosen_id,
            'created_at' => '2023-05-30 00:00:00',
            'updated_at' => '2023-05-30 00:00:00',
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (ModelKinerjaDosen $kinerjaDosen) {
            // Validate uniqueness after creating the record

           $validGan = $kinerjaDosen->validateUnique([
                'tahun_akademik' => $kinerjaDosen->tahun_akademik,
                'semester' => $kinerjaDosen->semester,
                'dosen_id' => $kinerjaDosen->dosen_id]);
            if ($validGan) {
                $kinerjaDosen->delete();

                $this->create();
            }







        });
    }
}

