<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $medicines = [
            [
                'scientific_name' => 'Ibuprofen',
                'commercial_name' => 'Advil',
                'warehouse_id'=>1,
                'medicine_category_id' => 1,
                'category' => 'Pain Relief',
                'the_manufacture_company' => 'Pfizer',
                'quantity' => 100,
                'expire_date' => '2026-12-31',
                'price' => 9.99,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Acetaminophen',
                'commercial_name' => 'Tylenol',
                'warehouse_id'=>1,
                'category' => 'Pain Relief',
                'medicine_category_id' => 1,
                'the_manufacture_company' => 'Johnson & Johnson',
                'quantity' => 150,
                'expire_date' => '2026-11-30',
                'price' => 8.49,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Naproxen',
                'commercial_name' => 'Aleve',
                'warehouse_id'=>1,
                'medicine_category_id' => 1,
                'category' => 'Pain Relief',
                'the_manufacture_company' => 'Bayer',
                'quantity' => 120,
                'expire_date' => '2026-10-31',
                'price' => 12.75,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Aspirin',
                'commercial_name' => 'Bayer Aspirin',
                'warehouse_id'=>1,
                'medicine_category_id' => 1,
                'category' => 'Pain Relief',
                'the_manufacture_company' => 'Bayer',
                'quantity' => 80,
                'expire_date' => '2026-09-30',
                'price' => 6.99,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Diclofenac',
                'commercial_name' => 'Voltaren',
                'warehouse_id'=>1,
                'medicine_category_id' => 1,
                'category' => 'Pain Relief',
                'the_manufacture_company' => 'Novartis',
                'quantity' => 90,
                'expire_date' => '2026-08-31',
                'price' => 15.25,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Codeine',
                'commercial_name' => 'Tylenol with Codeine',
                'warehouse_id'=>1,
                'medicine_category_id' => 1,
                'category' => 'Pain Relief',
                'the_manufacture_company' => 'Johnson & Johnson',
                'quantity' => 60,
                'expire_date' => '2026-07-31',
                'price' => 18.50,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Tramadol',
                'commercial_name' => 'Ultram',
                'warehouse_id'=>1,
                'medicine_category_id' => 1,
                'category' => 'Pain Relief',
                'the_manufacture_company' => 'Pfizer',
                'quantity' => 110,
                'expire_date' => '2026-06-30',
                'price' => 22.99,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Morphine',
                'commercial_name' => 'MS Contin',
                'warehouse_id'=>1,
                'medicine_category_id' => 1,
                'category' => 'Pain Relief',
                'the_manufacture_company' => 'Purdue Pharma',
                'quantity' => 75,
                'expire_date' => '2026-05-31',
                'price' => 30.75,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Hydrocodone',
                'commercial_name' => 'Vicodin',
                'warehouse_id'=>1,
                'medicine_category_id' => 1,
                'category' => 'Pain Relief',
                'the_manufacture_company' => 'Abbott Laboratories',
                'quantity' => 100,
                'expire_date' => '2026-04-30',
                'price' => 25.99,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Oxycodone',
                'commercial_name' => 'OxyContin',
                'warehouse_id'=>1,
                'medicine_category_id' => 1,
                'category' => 'Pain Relief',
                'the_manufacture_company' => 'Purdue Pharma',
                'quantity' => 40,
                'expire_date' => '2026-03-31',
                'price' => 35.50,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Gabapentin',
                'commercial_name' => 'Neurontin',
                'warehouse_id'=>1,
                'medicine_category_id' => 1,
                'category' => 'Pain Relief',
                'the_manufacture_company' => 'Pfizer',
                'quantity' => 120,
                'expire_date' => '2026-02-28',
                'price' => 28.75,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Pregabalin',
                'commercial_name' => 'Lyrica',
                'warehouse_id'=>1,
                'medicine_category_id' => 1,
                'category' => 'Pain Relief',
                'the_manufacture_company' => 'Pfizer',
                'quantity' => 55,
                'expire_date' => '2026-01-31',
                'price' => 32.99,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
        ];

        DB::table('medicines')->insert($medicines);


        $antibioticsCategoryId=2;
        $antibiotics = [
            [
                'scientific_name' => 'Amoxicillin',
                'commercial_name' => 'Amoxil',
                'category' => 'Antibiotics',
                'the_manufacture_company' => 'Pfizer',
                'quantity' => 120,
                'expire_date' => '2026-12-31',
                'price' => 15.99,
                'medicine_category_id' => $antibioticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Ciprofloxacin',
                'commercial_name' => 'Cipro',
                'category' => 'Antibiotics',
                'the_manufacture_company' => 'Bayer',
                'quantity' => 90,
                'expire_date' => '2027-01-31',
                'price' => 22.50,
                'medicine_category_id' => $antibioticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Azithromycin',
                'commercial_name' => 'Zithromax',
                'category' => 'Antibiotics',
                'the_manufacture_company' => 'Pfizer',
                'quantity' => 80,
                'expire_date' => '2027-02-28',
                'price' => 18.75,
                'medicine_category_id' => $antibioticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Doxycycline',
                'commercial_name' => 'Vibramycin',
                'category' => 'Antibiotics',
                'the_manufacture_company' => 'Pfizer',
                'quantity' => 100,
                'expire_date' => '2027-03-31',
                'price' => 20.99,
                'medicine_category_id' => $antibioticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Clindamycin',
                'commercial_name' => 'Cleocin',
                'category' => 'Antibiotics',
                'the_manufacture_company' => 'Pfizer',
                'quantity' => 60,
                'expire_date' => '2027-04-30',
                'price' => 27.25,
                'medicine_category_id' => $antibioticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Levofloxacin',
                'commercial_name' => 'Levaquin',
                'category' => 'Antibiotics',
                'the_manufacture_company' => 'Johnson & Johnson',
                'quantity' => 110,
                'expire_date' => '2027-05-31',
                'price' => 24.99,
                'medicine_category_id' => $antibioticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Metronidazole',
                'commercial_name' => 'Flagyl',
                'category' => 'Antibiotics',
                'the_manufacture_company' => 'Pfizer',
                'quantity' => 75,
                'expire_date' => '2027-06-30',
                'price' => 15.50,
                'medicine_category_id' => $antibioticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Cephalexin',
                'commercial_name' => 'Keflex',
                'category' => 'Antibiotics',
                'the_manufacture_company' => 'Eli Lilly',
                'quantity' => 95,
                'expire_date' => '2027-07-31',
                'price' => 23.75,
                'medicine_category_id' => $antibioticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Trimethoprim/Sulfamethoxazole',
                'commercial_name' => 'Bactrim',
                'category' => 'Antibiotics',
                'the_manufacture_company' => 'Roche',
                'quantity' => 85,
                'expire_date' => '2027-08-31',
                'price' => 19.99,
                'medicine_category_id' => $antibioticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Erythromycin',
                'commercial_name' => 'Erythrocin',
                'category' => 'Antibiotics',
                'the_manufacture_company' => 'Pfizer',
                'quantity' => 50,
                'expire_date' => '2027-09-30',
                'price' => 17.25,
                'medicine_category_id' => $antibioticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
        ];

        DB::table('medicines')->insert($antibiotics);


        $antipyreticsCategoryId=3;
        $antipyretics = [
            [
                'scientific_name' => 'Acetaminophen',
                'commercial_name' => 'Tylenol',
                'category' => 'Antipyretics',
                'the_manufacture_company' => 'Johnson & Johnson',
                'quantity' => 333,
                'expire_date' => '2026-12-31',
                'price' => 8.99,
                'medicine_category_id' => $antipyreticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Ibuprofen',
                'commercial_name' => 'Advil',
                'category' => 'Antipyretics',
                'the_manufacture_company' => 'Pfizer',
                'quantity' => 222,
                'expire_date' => '2027-01-31',
                'price' => 12.50,
                'medicine_category_id' => $antipyreticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Aspirin',
                'commercial_name' => 'Bayer Aspirin',
                'category' => 'Antipyretics',
                'the_manufacture_company' => 'Bayer',
                'quantity' => 430,
                'expire_date' => '2027-02-28',
                'price' => 9.75,
                'medicine_category_id' => $antipyreticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Naproxen',
                'commercial_name' => 'Aleve',
                'category' => 'Antipyretics',
                'the_manufacture_company' => 'Bayer',
                'quantity' => 300,
                'expire_date' => '2027-03-31',
                'price' => 15.99,
                'medicine_category_id' => $antipyreticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Paracetamol',
                'commercial_name' => 'Panadol',
                'category' => 'Antipyretics',
                'the_manufacture_company' => 'GlaxoSmithKline',
                'quantity' =>500,
                'expire_date' => '2027-04-30',
                'price' => 11.25,
                'medicine_category_id' => $antipyreticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Dipyrone',
                'commercial_name' => 'Novalgin',
                'category' => 'Antipyretics',
                'the_manufacture_company' => 'Bayer',
                'quantity' => 390,
                'expire_date' => '2027-05-31',
                'price' => 18.50,
                'medicine_category_id' => $antipyreticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Diclofenac',
                'commercial_name' => 'Voltaren',
                'category' => 'Antipyretics',
                'the_manufacture_company' => 'Novartis',
                'quantity' => 375,
                'expire_date' => '2027-06-30',
                'price' => 14.99,
                'medicine_category_id' => $antipyreticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Meloxicam',
                'commercial_name' => 'Mobic',
                'category' => 'Antipyretics',
                'the_manufacture_company' => 'Boehringer Ingelheim',
                'quantity' => 285,
                'expire_date' => '2027-07-31',
                'price' => 16.75,
                'medicine_category_id' => $antipyreticsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
        ];
        DB::table('medicines')->insert($antipyretics);

        $antidepressantsCategoryId=4;
        $antidepressants = [
            [
                'scientific_name' => 'Sertraline',
                'commercial_name' => 'Zoloft',
                'category' => 'Antidepressants',
                'the_manufacture_company' => 'Pfizer',
                'quantity' => 60,
                'expire_date' => '2026-12-31',
                'price' => 22.99,
                'medicine_category_id' => $antidepressantsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Fluoxetine',
                'commercial_name' => 'Prozac',
                'category' => 'Antidepressants',
                'the_manufacture_company' => 'Eli Lilly',
                'quantity' => 350,
                'expire_date' => '2027-01-31',
                'price' => 18.75,
                'medicine_category_id' => $antidepressantsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Escitalopram',
                'commercial_name' => 'Lexapro',
                'category' => 'Antidepressants',
                'the_manufacture_company' => 'Forest Laboratories',
                'quantity' => 240,
                'expire_date' => '2027-02-28',
                'price' => 25.50,
                'medicine_category_id' => $antidepressantsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Venlafaxine',
                'commercial_name' => 'Effexor',
                'category' => 'Antidepressants',
                'the_manufacture_company' => 'Pfizer',
                'quantity' => 130,
                'expire_date' => '2027-03-31',
                'price' => 30.99,
                'medicine_category_id' => $antidepressantsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Bupropion',
                'commercial_name' => 'Wellbutrin',
                'category' => 'Antidepressants',
                'the_manufacture_company' => 'GlaxoSmithKline',
                'quantity' => 245,
                'expire_date' => '2027-04-30',
                'price' => 27.25,
                'medicine_category_id' => $antidepressantsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
        ];

        DB::table('medicines')->insert($antidepressants);

        $antihypertensivesCategoryId=5;
        $antihypertensives = [
            [
                'scientific_name' => 'Amlodipine',
                'commercial_name' => 'Norvasc',
                'category' => 'Antihypertensives',
                'the_manufacture_company' => 'Pfizer',
                'quantity' => 270,
                'expire_date' => '2026-12-31',
                'price' => 15.99,
                'medicine_category_id' => $antihypertensivesCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Losartan',
                'commercial_name' => 'Cozaar',
                'category' => 'Antihypertensives',
                'the_manufacture_company' => 'Merck & Co.',
                'quantity' => 355,
                'expire_date' => '2027-01-31',
                'price' => 12.75,
                'medicine_category_id' => $antihypertensivesCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Enalapril',
                'commercial_name' => 'Vasotec',
                'category' => 'Antihypertensives',
                'the_manufacture_company' => 'Pfizer',
                'quantity' => 140,
                'expire_date' => '2027-02-28',
                'price' => 18.50,
                'medicine_category_id' => $antihypertensivesCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Hydrochlorothiazide',
                'commercial_name' => 'Microzide',
                'category' => 'Antihypertensives',
                'the_manufacture_company' => 'Novartis',
                'quantity' => 165,
                'expire_date' => '2027-03-31',
                'price' => 20.99,
                'medicine_category_id' => $antihypertensivesCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Metoprolol',
                'commercial_name' => 'Lopressor',
                'category' => 'Antihypertensives',
                'the_manufacture_company' => 'Novartis',
                'quantity' => 250,
                'expire_date' => '2027-04-30',
                'price' => 22.75,
                'medicine_category_id' => $antihypertensivesCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Captopril',
                'commercial_name' => 'Capoten',
                'category' => 'Antihypertensives',
                'the_manufacture_company' => 'Bristol-Myers Squibb',
                'quantity' => 160,
                'expire_date' => '2027-05-31',
                'price' => 17.99,
                'medicine_category_id' => $antihypertensivesCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
        ];

        DB::table('medicines')->insert($antihypertensives);


        $antihistaminesCategoryId=6;
        $antihistamines = [
            [
                'scientific_name' => 'Cetirizine',
                'commercial_name' => 'Zyrtec',
                'category' => 'Antihistamines',
                'the_manufacture_company' => 'Johnson & Johnson',
                'quantity' => 480,
                'expire_date' => '2026-12-31',
                'price' => 14.99,
                'medicine_category_id' => $antihistaminesCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Loratadine',
                'commercial_name' => 'Claritin',
                'category' => 'Antihistamines',
                'the_manufacture_company' => 'Bayer',
                'quantity' => 465,
                'expire_date' => '2027-01-31',
                'price' => 11.75,
                'medicine_category_id' => $antihistaminesCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Diphenhydramine',
                'commercial_name' => 'Benadryl',
                'category' => 'Antihistamines',
                'the_manufacture_company' => 'Johnson & Johnson',
                'quantity' => 350,
                'expire_date' => '2027-02-28',
                'price' => 17.50,
                'medicine_category_id' => $antihistaminesCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Fexofenadine',
                'commercial_name' => 'Allegra',
                'category' => 'Antihistamines',
                'the_manufacture_company' => 'Sanofi',
                'quantity' => 270,
                'expire_date' => '2027-03-31',
                'price' => 19.99,
                'medicine_category_id' => $antihistaminesCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Desloratadine',
                'commercial_name' => 'Clarinex',
                'category' => 'Antihistamines',
                'the_manufacture_company' => 'Merck & Co.',
                'quantity' => 355,
                'expire_date' => '2027-04-30',
                'price' => 16.25,
                'medicine_category_id' => $antihistaminesCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Levocetirizine',
                'commercial_name' => 'Xyzal',
                'category' => 'Antihistamines',
                'the_manufacture_company' => 'Sanofi',
                'quantity' => 280,
                'expire_date' => '2027-05-31',
                'price' => 15.99,
                'medicine_category_id' => $antihistaminesCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Chlorpheniramine',
                'commercial_name' => 'Chlor-Trimeton',
                'category' => 'Antihistamines',
                'the_manufacture_company' => 'Bayer',
                'quantity' => 345,
                'expire_date' => '2027-06-30',
                'price' => 13.99,
                'medicine_category_id' => $antihistaminesCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
        ];

        DB::table('medicines')->insert($antihistamines);

        $antidiabeticCategoryId=7;
        $antidiabeticMedications = [
            [
                'scientific_name' => 'Metformin',
                'commercial_name' => 'Glucophage',
                'category' => 'Anti-diabetic Medications',
                'the_manufacture_company' => 'Merck & Co.',
                'quantity' => 290,
                'expire_date' => '2026-12-31',
                'price' => 12.99,
                'medicine_category_id' => $antidiabeticCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Insulin Lispro',
                'commercial_name' => 'Humalog',
                'category' => 'Anti-diabetic Medications',
                'the_manufacture_company' => 'Eli Lilly',
                'quantity' => 275,
                'expire_date' => '2027-01-31',
                'price' => 29.75,
                'medicine_category_id' => $antidiabeticCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Sitagliptin',
                'commercial_name' => 'Januvia',
                'category' => 'Anti-diabetic Medications',
                'the_manufacture_company' => 'Merck & Co.',
                'quantity' => 260,
                'expire_date' => '2027-02-28',
                'price' => 18.50,
                'medicine_category_id' => $antidiabeticCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Gliclazide',
                'commercial_name' => 'Diamicron',
                'category' => 'Anti-diabetic Medications',
                'the_manufacture_company' => 'Servier',
                'quantity' => 350,
                'expire_date' => '2027-03-31',
                'price' => 15.99,
                'medicine_category_id' => $antidiabeticCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
        ];

        DB::table('medicines')->insert($antidiabeticMedications);
        
        $cardiovascularCategoryId=8;
        $cardiovascularMedications = [
            [
                'scientific_name' => 'Atorvastatin',
                'commercial_name' => 'Lipitor',
                'category' => 'Cardiovascular Medications',
                'the_manufacture_company' => 'Pfizer',
                'quantity' => 180,
                'expire_date' => '2026-12-31',
                'price' => 22.99,
                'medicine_category_id' => $cardiovascularCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Enoxaparin',
                'commercial_name' => 'Lovenox',
                'category' => 'Cardiovascular Medications',
                'the_manufacture_company' => 'Sanofi',
                'quantity' => 265,
                'expire_date' => '2027-01-31',
                'price' => 34.75,
                'medicine_category_id' => $cardiovascularCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Clopidogrel',
                'commercial_name' => 'Plavix',
                'category' => 'Cardiovascular Medications',
                'the_manufacture_company' => 'Bristol-Myers Squibb',
                'quantity' => 350,
                'expire_date' => '2027-02-28',
                'price' => 28.50,
                'medicine_category_id' => $cardiovascularCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
        ];

        DB::table('medicines')->insert($cardiovascularMedications);

        $respiratoryCategoryId=9;
        $respiratoryMedications = [
            [
                'scientific_name' => 'Albuterol',
                'commercial_name' => 'Ventolin',
                'category' => 'Respiratory Medications',
                'the_manufacture_company' => 'GlaxoSmithKline',
                'quantity' => 170,
                'expire_date' => '2026-12-31',
                'price' => 18.99,
                'medicine_category_id' => $respiratoryCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Fluticasone',
                'commercial_name' => 'Flovent',
                'category' => 'Respiratory Medications',
                'the_manufacture_company' => 'GlaxoSmithKline',
                'quantity' => 155,
                'expire_date' => '2027-01-31',
                'price' => 26.75,
                'medicine_category_id' => $respiratoryCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Montelukast',
                'commercial_name' => 'Singulair',
                'category' => 'Respiratory Medications',
                'the_manufacture_company' => 'Merck & Co.',
                'quantity' => 240,
                'expire_date' => '2027-02-28',
                'price' => 22.50,
                'medicine_category_id' => $respiratoryCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Ipratropium',
                'commercial_name' => 'Atrovent',
                'category' => 'Respiratory Medications',
                'the_manufacture_company' => 'Boehringer Ingelheim',
                'quantity' => 265,
                'expire_date' => '2027-03-31',
                'price' => 30.99,
                'medicine_category_id' => $respiratoryCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Budesonide',
                'commercial_name' => 'Pulmicort',
                'category' => 'Respiratory Medications',
                'the_manufacture_company' => 'AstraZeneca',
                'quantity' => 350,
                'expire_date' => '2027-04-30',
                'price' => 24.50,
                'medicine_category_id' => $respiratoryCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Dexamethasone',
                'commercial_name' => 'Decadron',
                'category' => 'Respiratory Medications',
                'the_manufacture_company' => 'Merck & Co.',
                'quantity' => 160,
                'expire_date' => '2027-05-31',
                'price' => 28.75,
                'medicine_category_id' => $respiratoryCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
        ];

        DB::table('medicines')->insert($respiratoryMedications);


        $anticoagulantsCategoryId=10;
        $anticoagulantsMedications = [
            [
                'scientific_name' => 'Warfarin',
                'commercial_name' => 'Coumadin',
                'category' => 'Anticoagulants and Antiplatelet Agents',
                'the_manufacture_company' => 'Bristol-Myers Squibb',
                'quantity' => 179,
                'expire_date' => '2026-12-31',
                'price' => 16.99,
                'medicine_category_id' => $anticoagulantsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Aspirin',
                'commercial_name' => 'Bayer Aspirin',
                'category' => 'Anticoagulants and Antiplatelet Agents',
                'the_manufacture_company' => 'Bayer',
                'quantity' => 165,
                'expire_date' => '2027-01-31',
                'price' => 10.75,
                'medicine_category_id' => $anticoagulantsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Clopidogrel',
                'commercial_name' => 'Plavix',
                'category' => 'Anticoagulants and Antiplatelet Agents',
                'the_manufacture_company' => 'Bristol-Myers Squibb',
                'quantity' => 250,
                'expire_date' => '2027-02-28',
                'price' => 24.50,
                'medicine_category_id' => $anticoagulantsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'scientific_name' => 'Rivaroxaban',
                'commercial_name' => 'Xarelto',
                'category' => 'Anticoagulants and Antiplatelet Agents',
                'the_manufacture_company' => 'Janssen Pharmaceuticals',
                'quantity' => 96,
                'expire_date' => '2027-03-31',
                'price' => 32.99,
                'medicine_category_id' => $anticoagulantsCategoryId,
                'warehouse_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
        ];

        DB::table('medicines')->insert($anticoagulantsMedications);

    }
}
