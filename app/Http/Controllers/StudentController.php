<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
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
        $students = User::whereHas('userschool', function ($query) {
            $query->where('role', 'student');
        })->with('userschool')->get();

        return view('pages.students.index', compact('schools', 'students'));
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

    public function getForm(User $student)
    {
        return response()->json([
            'id' => $student->id,
            'last_name' => $student->last_name,
            'first_name' => $student->first_name,
            'email' => $student->email,
            'birth_date' => $student->birth_date,
            'school_id' => $student->school()?->id,

        ]);
    }


    public function update(UpdateStudentRequest $request, User $student)
    {
        $student->update($request->validated());
        return redirect()->route('student.index')->with('success','The student has been updated successfully');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        UserSchool::where('user_id', $user->id)->delete();

        $user->delete();

        return redirect()->route('student.index');
    }


}
