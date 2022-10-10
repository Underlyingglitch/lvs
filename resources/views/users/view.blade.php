@extends('inc.app')
@php($page_id = 'students')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Leerling details</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('students') }}">students</a></li>
            <li class="breadcrumb-item active">{{ $leerling->user->name }}</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user me-1"></i>
                Persoonlijke gegevens
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Naam</label>
                            <input class="form-control" type="text" id="name" value="{{ $leerling->user->name }}"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="leerlingnummer">Leerlingnummer</label>
                            <input class="form-control" type="text" id="leerlingnummer"
                                value="{{ $leerling->leerlingnummer }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="klas">Klas</label>
                            <input class="form-control" type="text" id="klas" value="{{ $leerling->klas }}"
                                readonly>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5">
                            <label for="email">Email adres</label>
                            <input class="form-control" type="text" id="email" value="{{ $leerling->user->email }}"
                                readonly>
                        </div>
                        <div class="col-md-3">
                            <label>Laatst online</label><br>
                            @if (strtotime($leerling->user->last_seen) > strtotime('-1 minutes'))
                                <span class="text-success">Nu</span>
                            @else
                                <span
                                    class="text-secondary">{{ Carbon\Carbon::parse($leerling->user->last_seen)->diffForHumans() }}</span>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <label for="buddie">Buddie</label>
                            <input class="form-control" type="text" id="buddie"
                                value="{{ $leerling->buddie->user->name }}" readonly>
                        </div>
                    </div>
                </form>
            </div>
            {{-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> --}}
        </div>
        <div class="row">
            {{-- <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-users"></i>
                    Gekoppelde students
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div> --}}
        </div>
    </div>
@endsection
