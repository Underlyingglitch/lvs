@extends('inc.app')
@php($page_id = 'conversations')

@section('title', 'Gesprekken')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">
            Gesprekken
            <a class="btn btn-success" href="{{ route('conversations.create') }}">
                <i class="fas fa-plus"></i>
                Nieuw
            </a>
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Gesprekken</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Overzicht gesprekken
            </div>
            <div class="card-body">
                <table id="dataTable" class="table table-striped table-bordered" style="display:none">
                    <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Organisator</th>
                            <th>Uitgenodigd</th>
                            <th>Voorbereiding</th>
                            <th>Afgerond?</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Datum</th>
                            <th>Organisator</th>
                            <th>Uitgenodigd</th>
                            <th>Voorbereiding</th>
                            <th>Afgerond?</th>
                            <th>Acties</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($conversations as $conversation)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($conversation->conversation_date)->format('d-m-Y H:i') }}</td>
                                <td>{{ $conversation->organizer->name }}</td>
                                <td>{{ $conversation->invitees->pluck('name')->implode(', ') }}</td>
                                @if ($conversation->my_preparation)
                                    <td style="text-align: center; color:green">JA</td>
                                @else
                                    <td style="text-align: center; color:red">NEE</td>
                                @endif
                                @if ($conversation->report)
                                    <td style="text-align: center; color:green">JA</td>
                                @else
                                    <td style="text-align: center; color:red">NEE</td>
                                @endif
                                <td>
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('conversations.show', ['id' => $conversation->id]) }}"><i
                                            class="fas fa-info-circle"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
