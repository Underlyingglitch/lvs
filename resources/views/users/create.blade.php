@extends('inc.app')
@php($page_id = 'users')

@section('title', 'Nieuwe gebruiker')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Gebruiker aanmaken</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Nieuwe gebruiker</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user me-1"></i>
                Persoonlijke gegevens
            </div>
            <div class="card-body">
                @if (isset($user))
                    <div class="alert alert-success">
                        <h4 class="alert-heading">Gebruiker aangemaakt!</h4>
                        Gebruiker aangemaakt met gegevens:<br>
                        Email: {{ $user->email }}<br>
                        Wachtwoord: {{ $password }}
                        <hr>
                        <b>Let op:</b> deze gegevens worden maar 1x verstrekt
                    </div>
                @endif
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Naam</label>
                            <input class="form-control" type="text" id="name" name="name">
                        </div>
                        <div class="col-md-4">
                            <label for="studentid">Leerlingnummer</label>
                            <input class="form-control" type="text" id="studentid" name="studentid">
                        </div>
                        <div class="col-md-4">
                            <label for="group">Klas</label>
                            <input class="form-control" type="text" id="group" name="group">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5">
                            <label for="email">Email adres</label>
                            <input class="form-control" type="text" id="email" name="email">
                        </div>
                        <div class="col-md-2">
                            <label for="type">Gebruikerstype</label>
                            <select class="form-control" id="type" name="type">
                                <option value="student" @if (request()->get('type') == 'student') selected @endif>Leerling</option>
                                <option value="buddie" @if (request()->get('type') == 'buddie') selected @endif>Buddy</option>
                                <option value="teacher" @if (request()->get('type') == 'teacher') selected @endif>Docent</option>
                            </select>
                        </div>
                        <div class="col-md-3" id="buddieField" style="display:none">
                            <label for="buddie">Buddie</label>
                            <select class="form-control" name="buddie" id="buddie">
                                <option value="none">--</option>
                                @foreach ($buddies as $buddie)
                                    <option value="{{ $buddie->id }}" @if (request()->get('buddie_id') == $buddie->id) selected @endif>
                                        {{ $buddie->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="submit">&nbsp;</label>
                            <input class="form-control btn btn-primary" type="submit" id="submit" value="Opslaan">
                        </div>
                    </div>
                </form>
                <script>
                    if ($('#type').val() == "student") {
                        $('#buddieField').show()
                    }
                    $('#type').change(function() {
                        if ($(this).val() != "student") {
                            $('#buddieField').hide()
                        } else {
                            $('#buddieField').show()
                        }
                    })
                </script>
            </div>
        </div>
    </div>
@endsection
