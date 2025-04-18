<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $userRole = auth()->user()->school()->pivot->role;

        if ($userRole == 'admin') {
            $cohortcount = Cohort::all()->count();
            $studentcount = User::whereHas('UserSchool', function ($query) {
                $query->where('users_schools.role', 'student');
            })->count();
            $teachercount = User::whereHas('UserSchool', function ($query) {
                $query->where('users_schools.role', 'teacher');
            })->count();

            return view('pages.dashboard.dashboard-admin', compact('cohortcount', 'studentcount', 'teachercount'));
        }

        return view('pages.dashboard.dashboard-' . $userRole);
    }
}
