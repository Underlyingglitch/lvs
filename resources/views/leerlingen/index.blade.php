@extends('inc.app')
{{ $page_id = 'leerlingen' }}

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
                            <th>Buddie</th>
                            <th>Laatst gezien</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Leerlingnummer</th>
                            <th>Naam</th>
                            <th>Email</th>
                            <th>Buddie</th>
                            <th>Laatst gezien</th>
                            <th>Acties</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($leerlingen as $leerling)
                            <tr>
                                <td>{{ $leerling->leerlingnummer }}</td>
                                <td>{{ $leerling->user->name }}</td>
                                <td>{{ $leerling->user->email }}</td>
                                <td>
                                    @if ($leerling->buddie != null)
                                        {{ $leerling->buddie->user->name }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if (strtotime($leerling->user->last_seen) > strtotime('-1 minutes'))
                                        <span class="text-success">Online</span>
                                    @elseif($leerling->user->last_seen == null)
                                        <span class="text-secondary">Nooit</span>
                                    @else
                                        <span
                                            class="text-secondary">{{ Carbon\Carbon::parse($leerling->user->last_seen)->diffForHumans() }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('leerlingen.show', ['id' => $leerling->id]) }}"><i
                                            class="fas fa-info"></i></a>
                                    @can('leerlingen.edit')
                                        <a class="btn btn-sm btn-warning"
                                            href="{{ route('leerlingen.edit', ['id' => $leerling->id]) }}"><i
                                                class="fas fa-pencil"></i></a>
                                    @endcan
                                    @can('leerlingen.delete')
                                        <a class="btn btn-sm btn-danger"
                                            href="{{ route('leerlingen.destroy', ['id' => $leerling->id]) }}"><i
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
