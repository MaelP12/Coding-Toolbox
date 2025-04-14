@extends('layouts.modal', [
    'id'    => 'teacher-modal',
    'title'  => 'Informations enseignant',] )

@section('modal-content')
    <form method="POST" class="card-body flex flex-col gap-5 p-5" action="{{ route('teacher.update', ['student' => $student]) }}">
        @csrf

        <x-forms.input name="last_name" :label="__('Last Name')" />
        <x-forms.error name="last_name"/>

        <x-forms.input name="first_name" :label="__('First Name')" />
        <x-forms.error name="first_name"/>

        <x-forms.input name="email" :label="__('Email')" />
        <x-forms.error name="email"/>

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
@overwrite
