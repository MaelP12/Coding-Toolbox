<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCohortRequest;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Mail\SendUserPassword;
use App\Models\Cohort;
use App\Models\CohortTeacher;
use App\Models\School;
use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CohortController extends Controller
{
    /**
     * Display all available cohorts
     * @return Factory|View|Application|object
     */
    public function index()
    {
        $cohorts = Cohort::all();

        $schools = School::all();

        return view('pages.cohorts.index', compact('cohorts', 'schools'));
    }

    /**
     * This function allows you to create a student database
     */

    public function store(CreateCohortRequest $request) {

        Cohort::create($request->validated());


        return back()->with('success', 'The student has been added successfully.');
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
        $cohort = Cohort::findOrFail($id);

        $cohort->delete();

        return back();
    }


    /**
     * Display a specific cohort
     * @param Cohort $cohort
     * @return Application|Factory|object|View
     */
    public function show(Cohort $cohort) {

        $students = User::whereHas('userschool', function ($query) use ($cohort) {
            $query->where('cohort_id', $cohort->id);
        })->get();

        $teachers = User::whereIn('id', function ($query) use ($cohort) {
            $query->select('user_id')
                ->from('cohort_teacher')
                ->where('cohort_id', $cohort->id);
        })->get();

        $users = $teachers->merge($students);

        $studentstoadd = User ::whereHas('UserSchool', function ($query) {
            $query -> where('users_schools.role', 'student');
        }) -> get();

        $teachertoadd = User ::whereHas('UserSchool', function ($query) {
            $query -> where('users_schools.role', 'teacher');
        }) -> get();

        $cohorts = Cohort::all();

        return view('pages.cohorts.show', compact('users', 'teachertoadd' ,'studentstoadd' , 'cohort' , 'cohorts'));
    }

    public function student(Request $request,Cohort $cohort) {
        $userSchool = UserSchool::where('user_id', $request->user_id)
            ->first();


        $userSchool->update([
            'cohort_id' => $cohort->id,
        ]);


        return back();
    }

    public function teacher(Request $request,Cohort $cohort) {
        CohortTeacher::create([
            'user_id' => $request->user_id,
            'cohort_id' => $cohort->id,
        ]);

        return back();
    }

    public function del($id) {
        $student = UserSchool::where('user_id', $id);

        $student->update([
            'cohort_id' => null,
        ]);
        return back();
    }


}
