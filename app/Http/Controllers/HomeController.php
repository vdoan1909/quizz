<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $subjects = Subject::latest("id")->take(6)->get();
        return view('client.index', compact("subjects"));
    }
}
