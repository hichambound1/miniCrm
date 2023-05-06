<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employe\EditMyAccountRequest;
use App\Models\User;
use App\Models\UserStatu;
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

    public function editMyAccount(EditMyAccountRequest $request)
    {
        $this->authorize('edit_employe');
        $employe_status=UserStatu::whereName('vérifie')->first();
        $employe= User::whereId(auth()->id())->update([
            "email"=>$request->email,
            "name"=>$request->name,
            "status_id"=>$employe_status->id,
            'birthday'=>$request->birthday,
            'tel'=>$request->tel,
            'address'=>$request->address,
        ]);
        if(isset($request->password)){
            $employe=User::whereId(auth()->id())->first();
            $employe->update([
                "password"=>$request->password
            ]);
        }
        return response()->json([
            'data' => $employe,
            'status'  => 200,
        ]);
    }
    public function myCompanyInfo()
    {
        $this->authorize('view_entreprise');
        return response()->json([
            'entreprise' => auth()->user()->entreprise,
            'status'  => 200,
        ]);
    }
    public function mycolleaguesInfo()
    {
        $this->authorize('view_employe');
        return response()->json([
            'data' =>auth()->user()->entreprise->users,
            'status'  => 200,
        ]);
    }
    public function myInfo()
    {
        $this->authorize('view_employe');
        return response()->json([
            'data' =>auth()->user(),
            'status'  => 200,
        ]);
    }
}
