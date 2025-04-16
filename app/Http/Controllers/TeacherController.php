<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeacherRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\UpdateTeacherRequest;
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

    public function getForm(User $teacher)
    {
        return response()->json([
            'id' => $teacher->id,
            'last_name' => $teacher->last_name,
            'first_name' => $teacher->first_name,
            'email' => $teacher->email,
            'school_id' => $teacher->school()?->id,
        ]);
    }


    public function update(UpdateTeacherRequest $request, User $teacher)
    {
        $teacher->update($request->validated());
        return redirect()->route('teacher.index')->with('success','The student has been updated successfully');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        UserSchool::where('user_id', $user->id)->delete();

        $user->delete();

        return redirect()->route('teacher.index');
    }
}
