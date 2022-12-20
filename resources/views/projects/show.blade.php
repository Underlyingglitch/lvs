@extends('inc.app')
@php($page_id = 'projects')

@section('title', 'Project details')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">
            Project: {{ $project->title }}
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            @can('viewAny', \App\Models\Project::class)
                <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projecten</a></li>
            @else
                <li class="breadcrumb-item active">Projecten</li>
            @endcan
            <li class="breadcrumb-item active">{{ $project->title }}</li>
        </ol>

        <div class="row">
            <div class="col-md-8">

                <div class="card mb-4">
                    <div class="card-header">
                        Leerlingnotities
                    </div>
                    <div class="card-body">
                        @if (auth()->user()->role == 'student')
                            <form action="{{ route('projects.savenotes', ['project' => $project->id]) }}" method="post">
                                @csrf()
                                <textarea class="form-control" name="notes" id="" cols="30" rows="10">{{ $project->notes }}</textarea>
                                <input class="btn btn-primary" type="submit" value="Opslaan">
                            </form>
                        @else
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        Project details
                    </div>
                    <div class="card-body">
                        <form>
                            <label for="student">Leerling:</label>
                            <input class="form-control" type="text" id="student" value="{{ $project->user->name }}"
                                readonly><br>
                            <label for="buddie">Buddy:</label>
                            <input class="form-control" type="text" id="buddie"
                                value="{{ $project->user->buddie->name }}" readonly><br>
                            <label for="student">Schooljaar:</label>
                            <input class="form-control" type="text" id="student"
                                value="{{ $project->schoolyear->name }}" readonly><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
