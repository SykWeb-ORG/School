<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prof;
use App\Models\Salle;
use App\Models\Student;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $profs = Prof::all()->take(4);
        $students = Student::all()->take(6);
        $salles = Salle::all()->take(6);
        return view('dash.main',compact(
            'profs',
            'students',
            'salles',
        ));
    }
}
