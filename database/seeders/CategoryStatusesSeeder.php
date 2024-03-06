<?php

namespace Database\Seeders;

use App\Models\CategoryStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryData = [
            ['category' => 'New'],
            ['category' => 'Ever Used'],
            ['category' => 'In User'],
            ['category' => 'Proses'],
            ['category' => 'Free'],
            ['category' => 'Repair'],
            ['category' => 'Lost'],
        ];

        foreach($categoryData as $key => $val) {
            CategoryStatus::create($val);
        }
    }
}
