<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $configs = [
            [
                'key' => 'hero_title',
                'value' => 'Be Prepared. Be a Scout.',
            ],
            [
                'key' => 'hero_description',
                'value' => 'Building character through adventure and service.',
            ],
            [
                'key' => 'about_title',
                'value' => 'About Our Scout Organization',
            ],
            [
                'key' => 'about_image',
                'value' => 'http://127.0.0.1:8000/',
                'type' => 'file',
            ],
            [
                'key' => 'about_description',
                'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.',
            ],
            [
                'key' => 'contact_phone',
                'value' => '089606265960',
            ],
            [
                'key' => 'contact_email',
                'value' => 'admin@mailinator.com',
            ],
            [
                'key' => 'contact_address',
                'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.',
            ],
        ];

        foreach ($configs as $config) {
            Config::create($config);
        }
    }
}
