<?php

namespace Database\Seeders;

use App\Models\InvitationStatu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvitionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status=[
            "annuler",
            "confirmé",
            "En cours",
        ];
        foreach($status as $statu){
            InvitationStatu::firstOrCreate(['name'=>$statu]);
        }
    }
}
