@extends('inc.app')
@php($page_id = 'students')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">
            Leerlingen
            <a class="btn btn-success" href="{{ route('users.create', ['type' => 'student']) }}">
                <i class="fas fa-plus"></i>
                Nieuw
            </a>
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Leerlingen</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Overzicht leerlingen
            </div>
            <div class="card-body">
                <table id="dataTable" class="table table-striped table-bordered" style="display:none">
                    <thead>
                        <tr>
                            <th>Leerlingnummer</th>
                            <th>Naam</th>
                            <th>Email</th>
                            <th>Klas</th>
                            <th>Buddy</th>
                            <th>Laatst gezien</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Leerlingnummer</th>
                            <th>Naam</th>
                            <th>Email</th>
                            <th>Klas</th>
                            <th>Buddy</th>
                            <th>Laatst gezien</th>
                            <th>Acties</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->studentid }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->group }}</td>
                                <td>
                                    @if ($student->buddie != null)
                                        {{ $student->buddie->name }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if (strtotime($student->last_seen) > strtotime('-1 minutes'))
                                        <span class="text-success">Online</span>
                                    @elseif($student->last_seen == null)
                                        <span class="text-secondary">Nooit</span>
                                    @else
                                        <span
                                            class="text-secondary">{{ Carbon\Carbon::parse($student->last_seen)->diffForHumans() }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('students.show', ['student' => $student->id]) }}"><i
                                            class="fas fa-info-circle"></i></a>
                                    @can('students.edit')
                                        <a class="btn btn-sm btn-warning"
                                            href="{{ route('students.edit', ['student' => $student->id]) }}"><i
                                                class="fas fa-pencil"></i></a>
                                    @endcan
                                    @can('students.delete')
                                        <a class="btn btn-sm btn-danger"
                                            href="{{ route('students.destroy', ['student' => $student->id]) }}"><i
                                                class="fas fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

{{}}
