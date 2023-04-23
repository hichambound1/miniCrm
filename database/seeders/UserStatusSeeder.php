<?php

namespace Database\Seeders;

use App\Models\UserStatu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status=[
            "vérifie",
            "En cours",
        ];
        foreach($status as $statu){
            UserStatu::firstOrCreate(['name'=>$statu]);
        }
    }
}
