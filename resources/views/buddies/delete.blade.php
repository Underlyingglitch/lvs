@extends('inc.app')
{{ $page_id = 'buddies' }}

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Buddie verwijderen</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('buddies.index') }}">Buddies</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('buddies.show', ['id' => $buddie->id]) }}">{{ $buddie->user->name }}</a>
            </li>
            <li class="breadcrumb-item active">Verwijderen</li>
        </ol>

        <div>
            Weet u zeker dat u <b>{{ $buddie->user->name }}</b> als buddie wilt verwijderen? Alle data zal verloren gaan,
            maar het gebruikersaccount blijft behouden.
        </div>
        <form action="{{ route('buddies.destroy', ['id' => $buddie->id]) }}" method="post">
            @csrf
            <button class="btn btn-danger" type="submit">Bevestigen</button>
            <button class="btn btn-secondary" href="{{ url()->previous() }}">Annuleren</button>
        </form>
    </div>
@endsection
