<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicineCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Pain Relief',
            'Antibiotics',
            'Antipyretics',
            'Antidepressants',
            'Antihypertensives',
            'Antihistamines',
            'Anti-diabetic Medications',
            'Cardiovascular Medications',
            'Respiratory Medications',
            'Anticoagulants and Antiplatelet Agents',
        ];

        foreach ($categories as $category) {
            DB::table('medicine_categories')->insert([
                'category' => $category,
            ]);
        }
    }
}
