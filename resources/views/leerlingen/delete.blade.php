@extends('inc.app')
{{ $page_id = 'leerlingen' }}

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Leerling verwijderen</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('leerlingen.index') }}">Leerlingen</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('leerlingen.show', ['id' => $leerling->id]) }}">{{ $leerling->user->name }}</a>
            </li>
            <li class="breadcrumb-item active">Verwijderen</li>
        </ol>

        <div>
            Weet u zeker dat u <b>{{ $leerling->user->name }}</b> als leerling wilt verwijderen? Alle data zal verloren
            gaan,
            maar het gebruikersaccount blijft behouden.
        </div>
        <form action="{{ route('leerlingen.destroy', ['id' => $leerling->id]) }}" method="post">
            @csrf
            <button class="btn btn-danger" type="submit">Bevestigen</button>
            <button class="btn btn-secondary" href="{{ url()->previous() }}">Annuleren</button>
        </form>
    </div>
@endsection
