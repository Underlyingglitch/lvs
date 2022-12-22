@extends('inc.app')
@php($page_id = 'students')

@section('title', $student->name)

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">
            Leerling details
            @can('update', [\App\Models\User::class, $student])
                <a class="btn btn-warning" href="{{ route('students.edit', ['student' => $student->id]) }}">Bewerk</a>
            @endcan
            @can('delete', [\App\Models\User::class, $student])
                <a class="btn btn-danger" href="{{ route('students.destroy', ['student' => $student->id]) }}">Verwijder</a>
            @endcan
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('students.index') }}">Leerlingen</a></li>
            <li class="breadcrumb-item active">{{ $student->name }}</li>
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
                            <input class="form-control" type="text" id="name" value="{{ $student->name }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="leerlingnummer">Leerlingnummer</label>
                            <input class="form-control" type="text" id="leerlingnummer" value="{{ $student->studentid }}"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="klas">Klas</label>
                            <input class="form-control" type="text" id="klas" value="{{ $student->group }}"
                                readonly>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="email">Email adres</label>
                            <input class="form-control" type="text" id="email" value="{{ $student->email }}"
                                readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="buddie">Buddy</label>
                            <input class="form-control" type="text" id="buddie"
                                value="@if ($student->buddie != null) {{ $student->buddie->name }} @else -- @endif"
                                readonly>
                        </div>
                        <div class="col-md-3">
                            <label>Laatst online</label><br>
                            @if (strtotime($student->last_seen) > strtotime('-1 minutes'))
                                <span class="text-success">Nu</span>
                            @else
                                <span
                                    class="text-secondary">{{ Carbon\Carbon::parse($student->last_seen)->diffForHumans() }}</span>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <label>Actieve project</label>
                            @if ($student->project()->exists())
                                <br><a
                                    href="{{ route('projects.show', ['project' => $student->project->id]) }}">{{ $student->project->title }}</a>
                            @else
                                --
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            {{-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> --}}
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb4">
                    <div class="card-header">
                        <i class="fas fa-sticky-note me-1"></i>
                        Buddie notities
                    </div>
                    <div class="card-body">
                        @if (auth()->user()->role == 'buddie')
                            <form action="{{ route('students.submitnotes', ['student' => $student->id]) }}" method="post">
                                @csrf
                                <textarea class="form-control" name="notes" id="" cols="30" rows="10" placeholder="Geen notities">
@if ($student->buddy_notes()->exists())
{{ $student->buddy_notes->notes }}
@endif
</textarea>
                                <input class="btn btn-primary" type="submit" value="Opslaan">
                            </form>
                        @else
                            @if ($student->buddy_notes()->exists())
                                {{ $student->buddy_notes->notes }}
                            @else
                                Geen notities
                            @endif
                        @endif

                    </div>
                </div>
            </div>
            @if (auth()->user()->role == 'teacher' || auth()->user()->role == 'admin')
                <div class="col-md-6">
                    <div class="card mb4">
                        <div class="card-header">
                            <i class="fas fa-sticky-note me-1"></i>
                            Docent notities
                        </div>
                        <div class="card-body">
                            <form action="{{ route('students.submitnotes', ['student' => $student->id]) }}" method="post">
                                @csrf
                                <textarea class="form-control" name="notes" id="" cols="30" rows="10" placeholder="Geen notities">
@if ($student->teacher_notes()->exists())
{{ $student->teacher_notes->notes }}
@endif
</textarea>
                                <input class="btn btn-primary" type="submit" value="Opslaan">
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
