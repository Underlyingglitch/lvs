@extends('inc.app')
@php($page_id = 'questions')

@section('title', 'Vragen')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">
            Vragen
            @can('questions.add')
                <a class="btn btn-success" href="{{ route('questions.create') }}"><i class="fas fa-plus"></i> Nieuw</a>
            @endcan
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Vragen</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Overzicht vragen
            </div>
            <div class="card-body">
                <table id="dataTable" class="table table-striped table-bordered" style="display:none">
                    <thead>
                        <tr>
                            <th>Titel</th>
                            <th>Eigenaar</th>
                            <th>Beantwoord</th>
                            <th>Gepubliceerd</th>
                            <th>Datum</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Titel</th>
                            <th>Eigenaar</th>
                            <th>Beantwoord</th>
                            <th>Gepubliceerd</th>
                            <th>Datum</th>
                            <th>Acties</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($questions as $question)
                            <tr>
                                <td>{{ $question->title }}</td>
                                <td>{{ $question->user->name }}</td>
                                <td>
                                    @if ($question->answer)
                                        <span style="color: green"><i class="fas fa-check"></i></span>
                                    @else
                                        <span style="color: red"><i class="fas fa-times"></i></span>
                                    @endif
                                </td>
                                <td>
                                    @if ($question->published)
                                        <span style="color: green"><i class="fas fa-check"></i></span>
                                    @else
                                        <span style="color: red"><i class="fas fa-times"></i></span>
                                    @endif
                                </td>
                                <td>{{ Carbon\Carbon::parse($question->created_at) }}</td>
                                <td>
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('questions.show', ['question' => $question->id]) }}"><i
                                            class="fas fa-info-circle"></i></a>
                                    @can('questions.delete')
                                        <a class="btn btn-sm btn-danger"
                                            href="{{ route('questions.delete', ['question' => $question->id]) }}"><i
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
