<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        return view('pages.students.index');
    }

    public function create(Request $request) {

        User::create([
            'last_name'     => $request->last_name,
            'first_name'    => $request->first_name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
        ]);


    }
}
