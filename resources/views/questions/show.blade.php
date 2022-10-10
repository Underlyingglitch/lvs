@extends('inc.app')
{{ $page_id = 'questions' }}

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">
            Vraag #{{ $question->id }}
            @can('questions.delete')
                <a class="btn btn-danger" href="{{ route('questions.delete', ['id' => $question->id]) }}">Verwijder</a>
            @endcan
            @if (auth()->user()->can('questions.publish') && $question->answer)
                <a class="btn @if ($question->published) btn-warning @else btn-success @endif"
                    href="{{ route('questions.publish', ['id' => $question->id]) }}">
                    @if ($question->published)
                        Niet publiceren
                    @else
                        Publiceren
                    @endif
                </a>
            @endif
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
                {{ $question->content }}
            </div>
            <div class="card-footer small text-muted">Door: {{ $question->user->name }} op {{ $question->created_at }}
            </div>
        </div>
        @if ($question->answer)
            <div class="card mb-4">
                <div class="card-header">
                    Antwoord
                    @can('answers.delete')
                        <a class="btn btn-danger" href="{{ route('questions.delete_answer', ['id' => $question->id]) }}"><i
                                class="fas fa-trash"></i></a>
                    @endcan
                </div>
                <div class="card-body">
                    {{ $question->answer->content }}
                </div>
                <div class="card-footer small text-muted">Door: {{ $question->answer->user->name }} op
                    {{ $question->answer->created_at }}
                </div>
            </div>
        @elseif(auth()->user()->can('answers.add'))
            <form action="{{ route('questions.answer', ['id' => $question->id]) }}" method="post">
                @csrf
                <textarea class="form-control" name="content" cols="30" rows="5" placeholder="Beantwoord deze vraag"></textarea>
                <br>
                <input class="btn btn-primary" type="submit" value="Antwoord plaatsen">
            </form>
        @endif
    </div>
@endsection
