<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $schools = School::all();
        return view('pages.students.index', compact('schools'));
    }

    /**
     * This function allows you to create a student database
     */

    public function create(Request $request) {

        $user = User::create([
            'last_name'     => $request->last_name,
            'first_name'    => $request->first_name,
            'email'         => $request->email,
            'birth_date'    => $request->year,
            'password'      => Hash::make($request->password),
        ]);

        UserSchool::create([
            'user_id'   => $user->id,
            'school_id' => $request->school_id,
            'role'      => 'student'
        ]);

        return redirect()->route('student.index')->with('succes','The student has been added successfully');
    }

}
