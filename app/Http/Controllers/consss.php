<?php

namespace App\Http\Controllers;

use App\User as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class consss extends Controller
{
    public function index(){

        return view('auth.login');
    }
   }
