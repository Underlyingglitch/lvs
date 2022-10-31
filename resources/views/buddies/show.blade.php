@extends('inc.app')
@php($page_id = 'buddies')

@section('title', $buddie->name)

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">
            Buddy details
            @can('buddies.edit')
                <a class="btn btn-warning" href="{{ route('buddies.edit', ['id' => $buddie->id]) }}">Bewerk</a>
            @endcan
            @can('buddies.delete')
                <a class="btn btn-danger" href="{{ route('buddies.destroy', ['id' => $buddie->id]) }}">Verwijder</a>
            @endcan
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('buddies.index') }}">Buddy's</a></li>
            <li class="breadcrumb-item active">{{ $buddie->name }}</li>
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
                            <input class="form-control" type="text" id="name" value="{{ $buddie->name }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="leerlingnummer">Leerlingnummer</label>
                            <input class="form-control" type="text" id="leerlingnummer" value="{{ $buddie->studentid }}"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="group">Klas</label>
                            <input class="form-control" type="text" id="group" value="{{ $buddie->group }}" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="email">Email adres</label>
                            <input class="form-control" type="text" id="email" value="{{ $buddie->email }}" readonly>
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
                            @foreach ($buddie->students as $student)
                                <tr>
                                    <td>
                                        <a class="btn-link" href="{{ route('students.show', ['id' => $student->id]) }}">
                                            {{ $student->name }} <i class="fas fa-arrow-up-right-from-square"></i>
                                        </a>
                                    </td>
                                    <td>{{ $student->studentid }}</td>
                                    <td>{{ $student->group }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
