@extends('inc.app')
@php($page_id = 'conversations')

@section('title', 'Nieuw gesprek')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Gesprek aanmaken</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('conversations.index') }}">Gesprekken</a></li>
            <li class="breadcrumb-item active">Nieuw gesprek</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-comments me-1"></i>
                Gesprek details
            </div>
            <div class="card-body">
                <form action="{{ route('conversations.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="date">Datum</label>
                            <input class="form-control" type="date" name="date" id="date"
                                value="{{ date('Y-m-d') }}">
                            <label for="invitee_search">Genodigde(n)</label>
                            <input class="form-control" type="text" id="invitee_search"
                                placeholder="Zoeken... (3 of meer karakters)">

                        </div>
                        <div class="col-md-6">
                            <label for="time">Tijd</label>
                            <input class="form-control" type="time" name="time" id="time"
                                value="{{ date('H:i') }}">

                            <label for="">Selecteer</label>
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
                        </div>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Gesprek aanmaken">

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
            </div>
        </div>
    </div>
@endsection
