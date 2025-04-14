<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Enseignants') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">Liste des enseignants</h3>
                        <div class="input input-sm max-w-48">
                            <i class="ki-filled ki-magnifier"></i>
                            <input placeholder="Rechercher un enseignant" type="text"/>
                        </div>
                    </div>
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="5">
                            <div class="scrollable-x-auto">
                                <table class="table table-border" data-datatable-table="true">
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
                                                <span class="sort-label">Email</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="w-[70px]"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($teachers as $teacher)
                                        <tr>
                                            <td>{{$teacher->last_name}}</td>
                                            <td>{{$teacher->first_name}}</td>
                                            <td>{{$teacher->email}}</td>
                                            <td>
                                                <div class="flex items-center justify-between">
                                                    <form action="{{ route('student.delete', $teacher->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete this teacher?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="cursor-pointer text-red-600">
                                                            <i class="ki-filled ki-trash"></i>
                                                        </button>
                                                    </form>



                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
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
                        Ajouter un Enseignant
                    </h3>
                </div>
                <div class="card-body flex flex-col gap-5">
                    <form method="POST" class="card-body flex flex-col gap-5 p-5" action="{{ route('teacher.store') }}">
                        @csrf

                        <x-forms.input name="last_name" :label="__('Last Name')"/>
                        <x-forms.error name="last_name" bag="create"/>

                        <x-forms.input name="first_name" :label="__('First Name')" />
                        <x-forms.error name="first_name"/>

                        <x-forms.input name="email" :label="__('Email')" />
                        <x-forms.error name="email"/>

                        <x-forms.input label="{{ __('Password') }}" name="password" type="password" :placeholder="__('Enter Password')"/>
                        <x-forms.error name="password"/>

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
            </div>
        </div>
    </div>
    <!-- end: grid -->
</x-app-layout>

@include('pages.teachers.teacher-modal')
