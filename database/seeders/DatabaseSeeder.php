<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(CategoryStatusesSeeder::class);
        $this->call(ConditionsSeeder::class);

        // $deviceData = [
        //     ['name' => 'Laptop'],
        //     ['name' => 'Komputer'],
        //     ['name' => 'Lampu'],
        //     ['name' => 'Printer'],
        // ];
        // DB::table('devices')->insert($deviceData);

        // $locationData = [
        //     [
        //         'name' => 'IT',
        //         'information' => 'Divisi IT',
        //     ],
        //     [
        //         'name' => 'HC',
        //         'information' => 'Divisi HC',
        //     ],
        // ];
        // DB::table('divisions')->insert($locationData);

        // $rackData = [
        //     ['explanation' => 'Lemari'],
        //     ['explanation' => 'Laci'],
        //     ['explanation' => 'Loker'],
        // ];
        // DB::table('racks')->insert($rackData);

        // $softwareskData = [
        //     [
        //         'name' => 'Windows 11',
        //         'information' => 'Home, aktif 1 tahun',
        //     ],
        //     [
        //         'name' => 'Adobe',
        //         'information' => 'Aktif 1 tahun',
        //     ],
        // ];
        // DB::table('softwares')->insert($softwareskData);

    }
}
