@extends('inc.app')
@php($page_id = 'buddies')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Buddy verwijderen</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('buddies.index') }}">Buddy's</a></li>
            <li class="breadcrumb-item"><a href="{{ route('buddies.show', ['id' => $buddie->id]) }}">{{ $buddie->name }}</a>
            </li>
            <li class="breadcrumb-item active">Verwijderen</li>
        </ol>

        <div>
            Weet u zeker dat u <b>{{ $buddie->name }}</b> wilt verwijderen? Alle data verbonden met dit
            gebruikersaccount zal verloren
            gaan en de gebruiker zal niet meer kunnen inloggen. Deze actie kan niet ongedaan gemaakt worden!
        </div>
        <form action="{{ route('buddies.destroy', ['id' => $buddie->id]) }}" method="post">
            @csrf
            <button class="btn btn-danger" type="submit">Bevestigen</button>
            <button class="btn btn-secondary" href="{{ url()->previous() }}">Annuleren</button>
        </form>
    </div>
@endsection
