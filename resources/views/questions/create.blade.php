@extends('inc.app')
@php($page_id = 'questions')

@section('title', 'Nieuwe vraag')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">
            Nieuwe vraag
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('questions.index') }}">Vragen</a></li>
            <li class="breadcrumb-item active">Nieuwe vraag</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('questions.store') }}" method="post">
                    @csrf
                    <label for="title">Titel</label>
                    <input class="form-control" id="title" type="text" name="title"
                        placeholder="Korte omschrijving"><br>

                    <label for="content">Vraag</label>
                    <textarea class="form-control" id="content" name="content" cols="30" rows="10"
                        placeholder="Uitgebreidere uitleg voor je vraag"></textarea><br>

                    <input class="btn btn-primary" type="submit" value="Opslaan">
                    <button class="btn btn-secondary" href="{{ url()->previous() }}">Annuleren</button>
                </form>
            </div>
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
