@extends('layouts.modal', [
    'id'    => 'cohort-modal',
    'title' => 'Informations cohorte',
])

@section('modal-content')
    <form method="POST" action="{{ route('cohort.update', ['cohort' => $cohort]) }}">
        @csrf

        <x-forms.input name="name" :label="__('Nom de la cohorte')" />
        <x-forms.input type="date" name="start_date" :label="__('Date de début')" />
        <x-forms.input type="date" name="end_date" :label="__('Date de fin')" />

        <x-forms.primary-button>{{ __('Modifier') }}</x-forms.primary-button>
    </form>
@endsection
