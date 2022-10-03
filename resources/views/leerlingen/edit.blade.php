@extends('inc.app')
{{ $page_id = 'leerlingen' }}

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Leerling bewerken</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('leerlingen.index') }}">Leerlingen</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('leerlingen.show', ['id' => $leerling->id]) }}">{{ $leerling->user->name }}</a></li>
            <li class="breadcrumb-item active">Bewerken</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user me-1"></i>
                Persoonlijke gegevens
            </div>
            <div class="card-body">
                <form action="{{ URL::signedRoute('leerlingen.edit', ['id' => $leerling->id]) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Naam</label>
                            <input class="form-control" type="text" name="name" id="name"
                                value="{{ $leerling->user->name }}">
                        </div>
                        <div class="col-md-4">
                            <label for="leerlingnummer">Leerlingnummer</label>
                            <input class="form-control" type="text" name="leerlingnummer" id="leerlingnummer"
                                value="{{ $leerling->leerlingnummer }}">
                        </div>
                        <div class="col-md-4">
                            <label for="klas">Klas</label>
                            <input class="form-control" type="text" name="klas" id="klas"
                                value="{{ $leerling->klas }}">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5">
                            <label for="email">Email adres</label>
                            <input class="form-control" type="text" name="email" id="email"
                                value="{{ $leerling->user->email }}">
                        </div>
                        <div class="col-md-3">
                            <label for="buddie">Buddie</label>
                            <select class="form-control" name="buddie" id="buddie">
                                <option value="none">--</option>
                                @foreach ($buddies as $buddie)
                                    <option value="{{ $buddie->id }}"
                                        @if ($leerling->buddie == null) @elseif($buddie->id == $leerling->buddie->id) selected @endif>
                                        {{ $buddie->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="submit">&nbsp;</label>
                            <input class="form-control btn btn-primary" id="submit" type="submit" value="Opslaan"><br>
                        </div>
                        <div class="col-md-2">
                            <label for="cancel">&nbsp;</label>
                            <button class="form-control btn btn-secondary" id="cancel" href="Opslaan">Annuleren</button>
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
                    Gekoppelde leerlingen
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div> --}}
        </div>
    </div>
@endsection
