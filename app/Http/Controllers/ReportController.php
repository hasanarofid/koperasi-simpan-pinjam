<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function shu()
    {
        return view('reports.shu');
    }

    public function transactions()
    {
        return view('reports.transactions');
    }
}
