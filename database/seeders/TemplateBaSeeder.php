<?php

namespace Database\Seeders;

use App\Models\TemplateBeritaAcara;
use Illuminate\Database\Seeder;


class TemplateBaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TemplateBeritaAcara::create([
            'nama' => 'Berita Acara PKL',
            'path' => 'uploads/template_ba_kp/template_ba_kp.docx'
        ]);
        TemplateBeritaAcara::create([
            'nama' => 'Berita Acara TA 1',
            'path' => 'uploads/template_ba_ta1/template_ba_ta1.docx'
        ]);
        TemplateBeritaAcara::create([
            'nama' => 'Berita Acara TA 2',
            'path' => 'uploads/template_ba_ta2/template_ba_ta2.docx'
        ]);
        TemplateBeritaAcara::create([
            'nama' => 'Berita Acara Komprehensif',
            'path' => 'uploads/template_ba_kompre/template_ba_kompre.docx'
        ]);
        TemplateBeritaAcara::create([
            'nama' => 'Berita Acara Tesis 1',
            'path' => 'uploads/template_s2_ba_ta1/template_s2_ba_ta1.docx'
        ]);
        TemplateBeritaAcara::create([
            'nama' => 'Berita Acara Tesis 2',
            'path' => 'uploads/template_s2_ba_ta2/template_s2_ba_ta2.docx'
        ]);
        TemplateBeritaAcara::create([
            'nama' => 'Berita Acara Sidang Tesis',
            'path' => 'uploads/template_s2_ba_kompre/template_s2_ba_kompre.docx'
        ]);


    }
}
