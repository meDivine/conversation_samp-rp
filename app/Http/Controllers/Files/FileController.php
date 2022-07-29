<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Models\script;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function scripts() {
        return view('components.files.scripts.home');
    }

    public function scriptsAdd() {
        return view('components.files.scripts.add');
    }
}
