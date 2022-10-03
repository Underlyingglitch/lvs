@extends('inc.app')
{{ $page_id = 'questions' }}

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Vragen</h1>
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
                <table id="dataTable" style="display:none">
                    <thead>
                        <tr>
                            <th>Titel</th>
                            <th>Eigenaar</th>
                            <th>Type</th>
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
                            <th>Type</th>
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
                                <td>{{ $question->getOwner() }}</td>
                                <td>{{ $question->getOwnerType() }}</td>
                                <td>
                                    @if ($question->answer_id != null)
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
                                        href="{{ route('questions.show', ['id' => $question->id]) }}"><i
                                            class="fas fa-info"></i></a>
                                    {{-- @can('leerlingen.edit')
                                        <a class="btn btn-sm btn-warning"
                                            href="{{ route('leerlingen.edit', ['id' => $leerling->id]) }}"><i
                                                class="fas fa-pencil"></i></a>
                                    @endcan
                                    @can('leerlingen.delete')
                                        <a class="btn btn-sm btn-danger"
                                            href="{{ route('leerlingen.destroy', ['id' => $leerling->id]) }}"><i
                                                class="fas fa-trash"></i></a>
                                    @endcan --}}
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
