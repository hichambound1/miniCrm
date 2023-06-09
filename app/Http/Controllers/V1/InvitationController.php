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
        $employe->assignRole('employe');
        $invitation_statu= InvitationStatu::whereName("En cours")->first();
        $invitation= Invitation::create([
            "entreprise_id"=>$request->entreprise_id,
            "user_id"=>$employe->id,
            "status_id"=>$invitation_statu->id
        ]);

        $data = ['name' => $request->name,'company'=>$company->name, 'email' => $request->email,"password"=>$password];
        dispatch(new SendEmailJob($request->email,$data));
        return response($invitation, 200);

    }
    public function MyInvitations()
    {
        $user=auth()->user();
        $invitations = Invitation::where('user_id',$user->id)->get();
        return response( $invitations,200);
    }
    public function cancelInvitation($id)
    {
        $invitation= Invitation::with("statu")->whereId($id)->first();
        if(isset($invitation)){
            if($invitation->statu->name==='confirmé'){
                return response("this invitation it's already confirmed",412);
            }
            $statu_invitation_cancel=InvitationStatu::whereName('annuler')->first();
            $invitation->update(["status_id"=>$statu_invitation_cancel->id]);
            return response("Invitation updated",200);
        }else{
            return response("Invitation not found",404);
        }
    }
}
