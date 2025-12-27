<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    function index() {
        return view("users.FAQ", ['data' => Question::getAll()]);
    } 
}
