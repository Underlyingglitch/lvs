@extends('inc.app')
@php($page_id = 'schedule')

@section('title', 'Rooster')

@section('content')
    {{-- @foreach ($events as $event)
        {{ $event->SUMMARY }} | {{ $event->DTSTART }}<br>
    @endforeach --}}
    <div class="container-fluid px-4">
        <h1 class="mt-4">Rooster</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Rooster</li>
        </ol>

        <div class="row">
            @foreach ($events as $day => $events)
                <div class="col-md-2">
                    <b>{{ date('D', strtotime($day)) }} {{ $day }}</b>
                    @foreach ($events as $event)
                        <div style="margin-bottom: 10px; background-color: {{ $event['background'] }}">
                            <div class="row" style="height: 40px">
                                <div class="col-md-6">{{ $event['vak'] }}</div>
                                <div class="col-md-6" style="text-align: right">{{ $event['location'] }}</div>
                            </div>
                            <div class="row" style="height: 40px">
                                <div class="col-md-6">{{ $event['teacher'] }}</div>
                                <div class="col-md-6" style="text-align: right">
                                    {{ date('H:m', strtotime($event['details']->DTSTART)) }}</div>
                            </div>
                            <a class="btn btn-sm {{ $event['button_class'] }}" style="margin: 10px; margin-top: 0"
                                @if (!$event['button_disabled']) href="{{ URL::signedRoute('schedule.request', [
                                    'timestamp' => $event['details']->DTSTART,
                                    'vak' => $event['vak'],
                                    'uid' => $event['details']->UID,
                                ]) }}" @endif>
                                <i class="fas fa-question-circle"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>

        <div>
            Betekenis kleuren:<br>
            <ul>
                <li>Lichtblauw = beschikbaar voor aanvraag</li>
                <li>Rood = niet beschikbaar</li>
                <li>Oranje = aanvraag wordt verwerkt</li>
                <li>Groen = aanvraag goedgekeurd</li>
            </ul>

        </div>
    </div>
@endsection
