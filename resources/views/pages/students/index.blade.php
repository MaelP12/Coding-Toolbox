<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Etudiants') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">Liste des étudiants</h3>
                        <div class="input input-sm max-w-48">
                            <i class="ki-filled ki-magnifier"></i>
                            <input placeholder="Rechercher un étudiant" type="text"/>
                        </div>
                    </div>
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="5">
                            <div class="scrollable-x-auto">
                                <table id="student-table" class="table table-border" data-datatable-table="true">
                                    <thead>
                                    <tr>
                                        <th class="min-w-[135px]">
                                            <span class="sort asc">
                                                 <span class="sort-label">Nom</span>
                                                 <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Prénom</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Date de naissance</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="w-[70px]"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if ($students->isEmpty())
                                        <tr>
                                            <td colspan="5" class="text-center text-gray-500">
                                                No students create
                                            </td>
                                        </tr>
                                    @else
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{$student->last_name}}</td>
                                            <td>{{$student->first_name}}</td>
                                            <td>{{$student->birth_date}}</td>
                                            <td>
                                                <div class="flex items-center justify-between">
                                                    <form action="{{ route('student.delete', $student->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete this student?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="cursor-pointer text-red-600">
                                                            <i class="ki-filled ki-trash"></i>
                                                        </button>
                                                    </form>


                                                    <a class="open-student-modal hover:text-primary cursor-pointer" href="#"
                                                       data-modal-toggle="#student-modal" data-route="{{ route('student.form', $student) }}">
                                                        <i class="ki-filled ki-cursor"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
                                <div class="flex items-center gap-2 order-2 md:order-1">
                                    Show
                                    <select class="select select-sm w-16" data-datatable-size="true" name="perpage"></select>
                                    per page
                                </div>
                                <div class="flex items-center gap-4 order-1 md:order-2">
                                    <span data-datatable-info="true"></span>
                                    <div class="pagination" data-datatable-pagination="true"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-1">
            <div class="card h-full">
                <div class="card-header">
                    <h3 class="card-title">
                        Ajouter un étudiant
                    </h3>
                </div>
                <div class="card-body flex flex-col gap-5">
                    <form method="POST" class="card-body flex flex-col gap-5 p-5" action="{{ route('student.store') }}">
                        @csrf

                        <x-forms.input name="last_name" :label="__('Last Name')"/>
                        <x-forms.error name="last_name" bag="create"/>

                        <x-forms.input name="first_name" :label="__('First Name')" />
                        <x-forms.error name="first_name"/>

                        <x-forms.input name="email" :label="__('Email')" />
                        <x-forms.error name="email"/>

                        <x-forms.input type="date" name="birth_date" :label="__('Birth Date')" placeholder="" />
                        <x-forms.error name="birth_date"/>

                        <x-forms.dropdown name="school_id" :label="__('Schools')">
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                            @endforeach
                        </x-forms.dropdown>
                        <x-forms.error name="school_id"/>

                        <x-forms.primary-button>
                            {{ __('Valider') }}
                        </x-forms.primary-button>
                    </form>
                </div>

                @if(session('success'))
                    <div class="mt-4 mx-10 p-4 bg-green-100 border border-green-300 shadow-sm" style="color: rgb(22, 163, 74)">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
        </div>
    </div>
    <!-- end: grid -->
</x-app-layout>

@include('pages.students.student-modal')
