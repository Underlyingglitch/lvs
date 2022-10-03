@extends('inc.app')
{{ $page_id = 'questions' }}

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">
            Leerling details
            @can('questions.delete')
                <a class="btn btn-danger" href="{{ route('questions.destroy', ['id' => $question->id]) }}">Verwijder</a>
            @endcan
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('questions.index') }}">Vragen</a></li>
            <li class="breadcrumb-item active">{{ $question->title }}</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                {{ $question->title }}
            </div>
            <div class="card-body">

            </div>
            <div class="card-footer small text-muted">Door: {{ $question->getOwner() }} op {{ $question->created_at }}
            </div>
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
