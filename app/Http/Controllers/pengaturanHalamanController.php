<?php

namespace App\Http\Controllers;

use App\Models\halaman;
use Illuminate\Http\Request;

class pengaturanHalamanController extends Controller
{
    function index()
    {   
        $datahalaman = halaman::orderBy('judul','asc')->get();
        return view("dashboard.pengaturanhalaman.index")->with('dataHalaman', $datahalaman);
    }
    function update()
    {

    }
}
