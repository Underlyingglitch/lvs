@extends('inc.app')
{{ $page_id = 'buddies' }}

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Buddy bewerken</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('buddies.index') }}">Buddy's</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('buddies.show', ['id' => $buddie->id]) }}">{{ $buddie->user->name }}</a>
            </li>
            <li class="breadcrumb-item active">Bewerken</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user me-1"></i>
                Persoonlijke gegevens
            </div>
            <div class="card-body">
                <form action="{{ URL::signedRoute('buddies.edit', ['id' => $buddie->id]) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Naam</label>
                            <input class="form-control" name="name" type="text" id="name"
                                value="{{ $buddie->user->name }}">
                        </div>
                        <div class="col-md-4">
                            <label for="leerlingnummer">Leerlingnummer</label>
                            <input class="form-control" name="leerlingnummer" type="text" id="leerlingnummer"
                                value="{{ $buddie->leerlingnummer }}">
                        </div>
                        <div class="col-md-4">
                            <label for="klas">Klas</label>
                            <input class="form-control" name="klas" type="text" id="klas"
                                value="{{ $buddie->klas }}">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="email">Email adres</label>
                            <input class="form-control" name="email" type="text" id="email"
                                value="{{ $buddie->user->email }}">
                        </div>
                        <div class="col-md-3">
                            <label for="submit">&nbsp;</label>
                            <input class="form-control btn btn-primary" id="submit" type="submit" value="Opslaan">
                        </div>
                        <div class="col-md-3">
                            <label for="submit">&nbsp;</label>
                            <a class="form-control btn btn-secondary" id="submit"
                                href="{{ url()->previous() }}">Annuleren</a>
                        </div>
                    </div>
                </form>
            </div>
            {{-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> --}}
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-users"></i>
                        Gekoppelde leerlingen
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Naam</th>
                                <th>Leerlingnummer</th>
                                <th>Klas</th>
                            </tr>
                            @foreach ($buddie->students as $leerling)
                                <tr>
                                    <td>
                                        <a class="btn-link" href="#">
                                            {{ $leerling->user->name }} <i class="fas fa-arrow-up-right-from-square"></i>
                                        </a>
                                    </td>
                                    <td>{{ $leerling->leerlingnummer }}</td>
                                    <td>{{ $leerling->klas }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
