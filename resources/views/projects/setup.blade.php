@extends('inc.app')
@php($page_id = 'projects')

@section('title', 'Nieuw project')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">
            Nieuw project
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Nieuw project</li>
        </ol>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-diagram-project"></i>
                        Project details
                    </div>
                    <div class="card-body">
                        <form action="{{ route('projects.store') }}" method="post">
                            @csrf
                            <input class="form-control" type="text" name="title"
                                placeholder="Korte omschrijving van het project (max 50 karakters)" maxlength="50"><br>
                            <textarea class="form-control" name="description"
                                placeholder="Uitgebreidere omschrijving van het project (kan nog gewijzigd worden)" cols="30" rows="10"></textarea><br>
                            <input class="btn btn-primary" type="submit" value="Project aanmaken">
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-info-circle"></i> Overige informatie
                    </div>
                    <div class="card-body">
                        <form>
                            <label for="buddie">Buddy</label>
                            <input class="form-control" type="text" value="{{ auth()->user()->buddie->name }}"
                                readonly><br>
                            <label for="schoolyear">Schooljaar</label>
                            <input class="form-control" type="text"
                                value="{{ \App\Models\SchoolYear::find(\App\Models\SchoolYear::current())->name }}"
                                readonly>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
