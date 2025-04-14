<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeacherRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\School;
use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $schools = School::all();
        $teachers = User::whereHas('userschool', function ($query) {
            $query->where('role', 'teacher');
        })->with('userschool')->get();

        return view('pages.teachers.index', compact('schools', 'teachers'));
    }

    public function store(CreateTeacherRequest $request) {

        $user = User::create($request->validated());

        UserSchool::create([
            'user_id'   => $user->id,
            'school_id' => $request->school_id,
            'role'      => 'teacher',
        ]);

        return redirect()->route('teacher.index')->with('success','The student has been added successfully');
    }

    public function getForm(User $student)
    {
        return response()->json([
            'id' => $student->id,
            'last_name' => $student->last_name,
            'first_name' => $student->first_name,
            'email' => $student->email,
            'birth_date' => $student->birth_date,
            'school_id' => $student->firstSchool()?->id,
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
