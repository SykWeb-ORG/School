<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diver;

class DiverController extends Controller
{
    public function index(){
        $divers = Diver::all();
        return view('divers.alldivers',compact('divers'));
    }

    public function store(Request $request)
    {
        //
        $diver = new Diver();
        $diver->type = $request->type;
        $diver->montant = $request->montant;
        $diver->date = $request->date;
        $diver->save();
        return redirect('/Diver');
    }
}