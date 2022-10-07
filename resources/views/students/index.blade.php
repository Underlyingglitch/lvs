@extends('inc.app')
@php($page_id = 'students')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Leerlingen</h1>
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
                <table id="dataTable" style="display:none">
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
                                <td>{{ $student->leerlingnummer }}</td>
                                <td>{{ $student->user->name }}</td>
                                <td>{{ $student->user->email }}</td>
                                <td>{{ $student->klas }}</td>
                                <td>
                                    @if ($student->buddie != null)
                                        {{ $student->buddie->user->name }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if (strtotime($student->user->last_seen) > strtotime('-1 minutes'))
                                        <span class="text-success">Online</span>
                                    @elseif($student->user->last_seen == null)
                                        <span class="text-secondary">Nooit</span>
                                    @else
                                        <span
                                            class="text-secondary">{{ Carbon\Carbon::parse($student->user->last_seen)->diffForHumans() }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('students.show', ['id' => $student->id]) }}"><i
                                            class="fas fa-info"></i></a>
                                    @can('students.edit')
                                        <a class="btn btn-sm btn-warning"
                                            href="{{ route('students.edit', ['id' => $student->id]) }}"><i
                                                class="fas fa-pencil"></i></a>
                                    @endcan
                                    @can('students.delete')
                                        <a class="btn btn-sm btn-danger"
                                            href="{{ route('students.destroy', ['id' => $student->id]) }}"><i
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
