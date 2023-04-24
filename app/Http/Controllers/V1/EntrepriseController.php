<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Entreprise\DeleteEntrepriseRequest;
use App\Http\Requests\Entreprise\EditEntrepriseRequest;
use App\Http\Requests\Entreprise\StoreEntrepriseRequest;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function getEntreprises()
    {
        $entreprises= Entreprise::paginate();
        return response()->json([
            'entreprises' => $entreprises,
            'status'  => 200,
        ]);
    }
    public function createEntreprise(StoreEntrepriseRequest $request)
    {
        $this->authorize('create_entreprise');
        $entreprise= Entreprise::create([
            'name'=>$request->name
        ]);
        return response()->json([
            'entreprise' => $entreprise,
            'status'  => 200,
        ]);
    }
    public function editEntreprise(EditEntrepriseRequest $request)
    {
        $this->authorize('edit_entreprise');
        $entreprise= Entreprise::whereId($request->id)->update([
            'name'=>$request->name
        ]);
        $entreprise= Entreprise::find($request->id);
        return response()->json([
            'entreprise' => $entreprise,
            'status'  => 200,
        ]);
    }
    public function deleteEntreprise(DeleteEntrepriseRequest $request)
    {
        $this->authorize('delete_entreprise');
        $entreprise= Entreprise::whereId($request->id)->with('users')->first();

        if(count($entreprise->users) === 0){
            $entreprise->delete();
            return response()->json([
                'message' => "la société supprimé avec success",
                'status'  => 200,
            ]);
        }else{
            return response()->json([
                'message' => "impossible de supprimer l'entreprise car elle a des employés",
                'status'  => 400,
            ]);
        }
    }
}
