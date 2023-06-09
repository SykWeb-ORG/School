<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salle;

class SalleController extends Controller
{
    public function store(Request $request){
        $salle = new Salle();
        $salles = Salle::all();
        foreach($salles as $s){
            if($s->salle_number == $request->salle_number){
                $message = "Cette numero est deja existe!";
                session()->flash('message', $message);
                return redirect()->route('allsalles');
            }
        }
        $salle->salle_number = $request->salle_number;
        $salle->save();
        return redirect()->route('allsalles');
    }

    public function showall(){
        $salles = Salle::all();
        return view('salle.allsalles',compact('salles'));
        session()->forget('message');
    }

    public function edit($id){
        $salle = Salle::find($id);
        return $salle;
    }

    public function update(Request $request, $id){
        $salle = Salle::find($id);
        $salles = Salle::all();
        foreach($salles as $s){
            if($s->salle_number == $request->salle_number){
                $message = "Cette numero est deja existe!";
                session()->flash('message', $message);
                return redirect()->route('allsalles');
            }
        }
        $salle->update($request->all());
        return redirect()->route('allsalles');
    }

    public function destroy($id)
    {
        $salle = Salle::find($id);
        $salle->delete();
        return redirect()->route('allsalles')->with('success', 'Room deleted successfully.');
    }
}
