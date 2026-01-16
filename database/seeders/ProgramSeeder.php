<?php

namespace Database\Seeders;


use App\Models\Program;

class ProgramSeeder extends \Illuminate\Database\Seeder
{
    public function run(): void
    {
        $items = [
            ['title'=>'Kelas & Webinar','excerpt'=>'Kelas ringkas dan webinar tematik untuk literasi hukum publik.','sort_order'=>1],
            ['title'=>'Konten Digital','excerpt'=>'Konten edukatif yang mudah dipahami, konsisten, dan relevan.','sort_order'=>2],
            ['title'=>'Riset & Policy Brief','excerpt'=>'Kajian berbasis data untuk memperkuat argumen kebijakan.','sort_order'=>3],
            ['title'=>'Kolaborasi','excerpt'=>'Ruang kerja sama lintas komunitas dan institusi.','sort_order'=>4],
        ];

        foreach ($items as $it) {
            Program::create(array_merge($it, [
                'is_active' => true,
                'body' => null,
                'cta_label' => 'Lihat',
                'cta_url' => route('program'),
            ]));
            }
        }
    }
