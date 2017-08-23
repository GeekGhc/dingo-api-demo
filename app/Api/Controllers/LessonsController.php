<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;

class LessonsController extends Controller
{
    public function index()
    {
        $lessons =  Lesson::all();

        return $lessons;
    }

    public function show($id)
    {

    }
}
