<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function ListOfEmployes(Request $request)
    {
        $employes= User::whereHas('roles',function($q){
            $q->where("name","employe");
        })
        ->when(isset($request->name), function ($q) use($request){
            $q->where('name','like', '%'.$request->name.'%');
        })
        ->when(isset($request->sort), function ($q) use($request){
            $q->orderBy('name',$request->sort);
        })
        ->paginate();

        return response($employes,200);
    }
}
