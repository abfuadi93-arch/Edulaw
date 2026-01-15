<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Insight;

class InsightSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'Hukum Privasi Digital di Asia Tenggara',
            'Reformasi Tata Kelola Perusahaan: Studi Perbandingan',
            'Aktivisme Yudisial dan Batasannya dalam Pengujian UU',
            'Membaca Putusan MK: Antara Tekstualisme dan Kontekstualisme',
        ];

        foreach ($titles as $title) {
            Insight::updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title'        => $title,
                    'excerpt'      => 'Ringkasan singkat untuk artikel insight: ' . $title,
                    'content'      => '<p>Konten contoh untuk <strong>' . e($title) . '</strong>. Silakan ganti dengan konten asli.</p>',
                    'status'       => 'published',
                    'published_at' => now(),
                    'user_id'      => null,
                ]
            );
        }
    }
}
