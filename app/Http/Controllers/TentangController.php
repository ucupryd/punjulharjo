<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerangkatDesa;

class TentangController extends Controller
{
    public function index()
    {
        return view('tentang', [
            'perangkat' => PerangkatDesa::orderBy('urutan')->get(),
        ]);
    }
}
