@extends('inc.app')
@php($page_id = 'test')

@section('title', 'Profiel')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Mijn profiel</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Mijn profiel</li>
        </ol>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-user"></i>
                        Persoonlijke gegevens
                    </div>
                    <div class="card-body">
                        <form action="{{ URL::signedRoute('profile.saveprofile') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name">Naam</label>
                                    <input class="form-control" type="text" name="name" id="name" readonly
                                        value="{{ auth()->user()->name }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="studentid">Leerlingnummer</label>
                                    <input class="form-control" type="text" name="studentid" id="studentid" readonly
                                        value="{{ auth()->user()->studentid }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="group">Klas</label>
                                    <input class="form-control" type="text" name="group" id="group"
                                        value="{{ auth()->user()->group }}">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="email">Email adres</label>
                                    <input class="form-control" type="text" name="email" id="email" readonly
                                        value="{{ auth()->user()->email }}">
                                </div>

                                <div class="col-md-2">
                                    <label for="submit">&nbsp;</label>
                                    <input class="form-control btn btn-primary" id="submit" type="submit"
                                        value="Opslaan"><br>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-lock"></i>
                        Wijzig wachtwoord
                    </div>
                    <div class="card-body">
                        @if (isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endif
                        <form action="{{ route('profile.storepassword') }}" method="post">
                            @csrf
                            <input class="form-control @error('current_password') is-invalid @enderror" type="password"
                                name="current_password" placeholder="Oude wachtwoord"><br>
                            @error('current_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input class="form-control @error('new_password') is-invalid @enderror" type="password"
                                name="new_password" placeholder="Nieuwe wachtwoord"><br>
                            @error('new_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input class="form-control @error('new_password_confirm') is-invalid @enderror" type="password"
                                name="new_password_confirm" placeholder="Bevestig nieuwe wachtwoord"><br>
                            @error('new_password_confirm')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input class="form-control btn btn-primary" type="submit" value="Wijzig wachtwoord">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
