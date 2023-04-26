<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invitation\StoreInvitationRequest;
use App\Jobs\SendEmailJob;
use App\Models\Entreprise;
use App\Models\Invitation;
use App\Models\InvitationStatu;
use App\Models\User;
use App\Models\UserStatu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function sendInvitation(StoreInvitationRequest $request)
    {
        $this->authorize('send_invite');
        $company= Entreprise::whereId($request->entreprise_id)->first();
        $employe_status=UserStatu::whereName('En cours')->first();
        $password=Hash::make(Str::random(5));
        $employe= User::create([
            "email"=>$request->email,
            "name"=>$request->name,
            "password"=>$password,
            "status_id"=>$employe_status->id,
            "entreprise_id"=>$company->id
        ]);
        $invitation_statu= InvitationStatu::whereName("En cours")->first();
        $invitation= Invitation::create([
            "entreprise_id"=>$request->entreprise_id,
            "user_id"=>$employe->id,
            "status_id"=>$invitation_statu->id
        ]);

        $data = ['name' => $request->name,'company'=>$company->name, 'email' => $request->email,"password"=>$password];
        dispatch(new SendEmailJob($request->email,$data));
        return response()->json([
            'data' => $invitation,
            'status'  => 200,
        ]);

    }
}
