<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserStatu;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status=UserStatu::where('name','vérifie')->first();
        $employes=[
            [
                'name'=>"employe 1",
                'email'=>"employe1@gmail.com",
                'password'=>Hash::make("employe123"),
                'birthday'=>Carbon::parse("1990-01-01"),
                'tel'=>"+212 6 43 43 43 43",
                'address'=>"address employe 1",
                'status_id'=>$status->id
            ],
            [
                'name'=>"employe 2",
                'email'=>"employe2@gmail.com",
                'password'=>Hash::make("employe123"),
                'birthday'=>Carbon::parse("1990-01-01"),
                'tel'=>"+212 6 43 43 43 43",
                'address'=>"address employe 1",
                'status_id'=>$status->id
            ]
        ];
        foreach ($employes as  $employe) {
            $item= User::firstOrCreate(["email"=>$employe["email"]],$employe);
            $item->assignRole("employe");
        }

    }
}
