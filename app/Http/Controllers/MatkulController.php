<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;
class MatkulController extends Controller
{
    public function index()
    {
        $matkuls = Matkul::all();
        return view('matkul.index', compact('matkuls'));
        //
    }
}