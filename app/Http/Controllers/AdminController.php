<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Models\User;
use App\Models\UserStatu;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function createAdmin(StoreAdminRequest $request)
    {
        $this->authorize('create_admin');
        $user_statu= UserStatu::whereName('vérifie')->first();
        $user= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'birthday'=>Carbon::parse($request->birthday),
            'tel'=>$request->tel,
            'address'=>$request->address,
            'status_id'=>$user_statu->id
        ]);
        $user->assignRole('admin');
        return response()->json([
            'user' => $user,
            'status'  => 200,
        ]);
    }
}
