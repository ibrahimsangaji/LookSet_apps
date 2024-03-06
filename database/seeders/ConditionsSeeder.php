<?php

namespace Database\Seeders;

use App\Models\Condition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conditionData = [
            ['type' => 'Very Good'],
            ['type' => 'Good'],
            ['type' => 'Not Good'],
            ['type' => 'Inbound'],
            ['type' => 'Return'],
            ['type' => 'Outbound'],
        ];

        foreach($conditionData as $key => $val) {
            Condition::create($val);
        }
    }
}
