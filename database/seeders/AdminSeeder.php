<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserStatu;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status=UserStatu::where('name','vérifie')->first();
        $admins=[
            [
                'name'=>"Admin 1",
                'email'=>"admin1@gmail.com",
                'password'=>Hash::make("admin123"),
                'birthday'=>Carbon::parse("1990-01-01"),
                'tel'=>"+212 6 43 43 43 43",
                'address'=>"address admin 1",
                'status_id'=>$status->id
            ],
            [
                'name'=>"Admin 2",
                'email'=>"admin2@gmail.com",
                'password'=>Hash::make("admin123"),
                'birthday'=>Carbon::parse("1990-01-01"),
                'tel'=>"+212 6 43 43 43 43",
                'address'=>"address admin 1",
                'status_id'=>$status->id
            ]
        ];
        foreach ($admins as  $admin) {
            $item= User::firstOrCreate(["email"=>$admin['email']],$admin);
            $item->assignRole("admin");
        }


    }
}
