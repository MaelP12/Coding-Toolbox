<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">{{ $cohort->name }}</span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">Etudiants</h3>
                    </div>
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="30">
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
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Role</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="max-w-[50px]"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if ($users->isEmpty())
                                        <tr>
                                            <td colspan="5" class="text-center text-gray-500">
                                                No students create
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{$user->last_name}}</td>
                                                <td>{{$user->first_name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{ $user->userschool->role ?? 'Non défini' }}</td>
                                            @can('view-no-promotions')
                                                <td>
                                                    <div class="flex items-center justify-between">
                                                        <form action="{{ route('cohort.del', $user->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete this student?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="cursor-pointer text-red-600">
                                                                <i class="ki-filled ki-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                                @endcan
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
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-stretch">
            <div class="card flex flex-col">
                <div class="card-header">
                    <h3 class="card-title">
                        Add student the promotion
                    </h3>
                </div>
                <div class="card-body flex flex-col gap-5">-
                    <form action="{{route('cohort.student', $cohort)}}" method="POST">
                        @csrf
                        <x-forms.dropdown name="user_id" :label="__('Etudiant')">
                            @foreach($studentstoadd as $user)
                                <option value="{{ $user->id }}">{{ $user->last_name }} {{ $user->first_name }}</option>
                            @endforeach
                        </x-forms.dropdown>

                        <x-forms.primary-button>
                            {{ __('Valider') }}
                        </x-forms.primary-button>
                    </form>
                </div>
            </div>
            <div class="card flex flex-col">
                <div class="card-header">
                    <h3 class="card-title">
                        Add teacher the promotion
                    </h3>
                </div>
                <div class="card-body flex flex-col gap-5">-
                    <form action="{{route('cohort.teacher', $cohort)}}" method="POST">
                        @csrf
                        <x-forms.dropdown name="user_id" :label="__('Teacher')">
                            @foreach($teachertoadd as $user)
                                <option value="{{ $user->id }}">{{ $user->last_name }} {{ $user->first_name }}</option>
                            @endforeach
                        </x-forms.dropdown>

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
