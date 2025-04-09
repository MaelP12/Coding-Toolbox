<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
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

    public function store(CreateStudentRequest $request) {

        $user = User::create($request->validated());

        UserSchool::create([
            'user_id'   => $user->id,
            'school_id' => $request->school_id,
            'role'      => 'student'
        ]);

        return redirect()->route('student.index')->with('success','The student has been added successfully');
    }

}
