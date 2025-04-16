<x-app-layout>
    <!-- _____________________________ -->
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Dashboard') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-2 gap-5 lg:gap-7.5 items-stretch">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-center align-items-center gap-5">
                    <h3 class="card-title m-0">Promotion</h3>
                    <span class="fs-2 fw-bold">{{$cohortcount}}</span>
                </div>
                <div class="card-footer d-flex justify-center">
                    <a href="/cohorts" class="btn btn-link">Link</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-center align-items-center gap-5">
                    <h3 class="card-title m-0">Groups</h3>
                    <span class="fs-2 fw-bold">7</span>
                </div>
                <div class="card-footer d-flex justify-center">
                    <a href="/groups" class="btn btn-link">Link</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-center align-items-center gap-5">
                    <h3 class="card-title m-0">Students</h3>
                    <span class="fs-2 fw-bold">{{$studentcount}}</span>
                </div>
                <div class="card-footer d-flex justify-center">
                    <a href="/students" class="btn btn-link">Link</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-center align-items-center gap-5">
                    <h3 class="card-title m-0">Teacher</h3>
                    <span class="fs-2 fw-bold">{{$teachercount}}</span>
                </div>
                <div class="card-footer d-flex justify-center">
                    <a href="/teachers" class="btn btn-link">Link</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end: grid -->
</x-app-layout>
