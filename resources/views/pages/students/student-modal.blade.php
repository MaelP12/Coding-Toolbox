@extends('layouts.modal', [
    'id'    => 'student-modal',
    'title'  => 'Informations étudiant',] )

@section('modal-content')
    @if ($students->isNotEmpty())
    <form method="POST" class="card-body flex flex-col gap-5 p-5" action="{{ route('student.update', ['student' => $student]) }}">
        @csrf

        <x-forms.input name="last_name" :label="__('Last Name')" />
        <x-forms.error name="last_name"/>

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
            {{ __('Modifier') }}
        </x-forms.primary-button>
    </form>
    @endif
@overwrite
