@extends('inc.app')
@php($page_id = 'questions')

@section('title', 'Verwijder vraag')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Vraag verwijderen</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('questions.index') }}">Vragen</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('questions.show', ['question' => $question->id]) }}">{{ $question->title }}</a>
            </li>
            <li class="breadcrumb-item active">Verwijderen</li>
        </ol>

        <div>
            Weet u zeker dat u de vraag van <b>{{ $question->user->name }}</b> met titel <b>{{ $question->title }}</b>
            wilt verwijderen?
        </div>
        <form action="{{ route('questions.destroy', ['question' => $question->id]) }}" method="post">
            @csrf
            <button class="btn btn-danger" type="submit">Bevestigen</button>
            <button class="btn btn-secondary" href="{{ url()->previous() }}">Annuleren</button>
        </form>
    </div>
@endsection
