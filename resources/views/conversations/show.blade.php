@extends('inc.app')
@php($page_id = 'conversations')

@section('title', 'Gespreksdetails')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">
            Gesprek details
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('conversations.index') }}">Gesprekken</a></li>
            <li class="breadcrumb-item active">Gesprek #{{ $conversation->id }}</li>
        </ol>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-comments me-1"></i>
                        Gesprek {{ \Carbon\Carbon::parse($conversation->conversation_date)->format('d-m-Y H:i') }}
                    </div>
                    <div class="card-body">
                        <h5>Voorbereiding</h5>
                        @can('create', [\App\Models\ConversationPreparation::class, $conversation])
                            <form action="{{ route('conversations.prepare', ['conversation' => $conversation->id]) }}"
                                method="post">
                                @csrf
                                <textarea class="form-control" name="preparation" placeholder="Voorbereiding" cols="30" rows="10">{{ $conversation->my_preparation ? $conversation->my_preparation->content : null }}</textarea>
                                <input class="btn btn-primary" type="submit" value="Opslaan">
                            </form>
                        @endcan
                        @foreach ($conversation->preparations->where('user_id', '!=', auth()->user()->id) as $preparation)
                            <b>{{ $preparation->user->name }}
                                <small>{{ \Carbon\Carbon::parse($preparation->created_at)->format('d-m-Y H:i') }}</small></b>
                            <div>{{ $preparation->content }}</div>
                            <hr>
                        @endforeach
                        @can('update', $conversation)
                            <h5>Gespreksverslag</h5>
                            <form action="{{ route('conversations.update', ['conversation' => $conversation->id]) }}"
                                method="post">
                                @csrf
                                <textarea class="form-control" name="report" cols="30" rows="10">{{ $conversation->report }}</textarea>
                                <input class="btn btn-primary" type="submit" value="Opslaan">
                            </form>
                        @else
                            @if ($conversation->report)
                                <h5>Gespreksverslag</h5>
                                {{ $conversation->report }}
                            @endif
                        @endcan
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-info-circle me-1"></i>
                        Gespreksdetails
                    </div>
                    <div class="card-body">
                        <label for="location">Locatie</label>
                        <input class="form-control" type="text" value="{{ $conversation->location }}" readonly>
                        <hr>
                        <label for="participants">Deelnemers</label>
                        <ul id="participants">
                            <li>{{ $conversation->organizer->name }} <span style="color: orange" data-toggle="tooltip"
                                    data-placement="top" title="Organisator"><i class="fas fa-crown"></i></span></li>

                            <form
                                action="{{ route('conversations.removeinvitee', ['conversation' => $conversation->id]) }}"
                                method="post">
                                @csrf
                                @foreach ($conversation->invitees as $invitee)
                                    <li>{{ $invitee->name }}
                                        @if ($conversation->report == null)
                                            @can('update', $conversation)
                                                <input class="btn btn-sm btn-danger" type="submit" name="{{ $invitee->id }}"
                                                    value="Verwijder">
                                            @endcan
                                        @endif
                                    </li>
                                @endforeach
                            </form>
                        </ul>
                        @if (auth()->user()->can('update', $conversation) && $conversation->report == null)
                            <hr>

                            <form action="{{ route('conversations.addinvitees', ['conversation' => $conversation->id]) }}"
                                method="post">
                                @csrf
                                <label for="search">Voeg deelnemer toe</label>
                                <input class="form-control" type="text" id="invitee_search"
                                    placeholder="Zoeken... (3 of meer karakters)">
                                @foreach ($users as $user)
                                    <div class="form-check" style="display: none" user-name="{{ $user->name }}"
                                        user-id="{{ $user->id }}">
                                        <input class="form-check-input" type="checkbox" name="invitees[]"
                                            value="{{ $user->id }}" id="user{{ $user->id }}">
                                        <label class="form-check-label" for="user{{ $user->id }}">
                                            {{ $user->name }}
                                        </label>
                                    </div>
                                @endforeach
                                <input class="btn btn-primary" type="submit" value="Uitnodigen">
                                <script>
                                    $(() => {
                                        $('#invitee_search').on('keyup', () => {
                                            let name = $('#invitee_search').val()
                                            if (name.length > 2) {
                                                $('.form-check').each(function() {
                                                    if ($(this).attr('user-name').toLowerCase().includes(name.toLowerCase())) {
                                                        console.log($(this).attr('user-name'))
                                                        $(this).show()
                                                    } else {
                                                        $(this).hide()
                                                    }
                                                })
                                            } else {
                                                $('.form-check').hide()
                                            }
                                        })
                                    })
                                </script>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
