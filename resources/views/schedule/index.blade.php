@extends('inc.app')
{{ $page_id = 'schedule' }}

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
                    {{-- @foreach (array_filter($events, function ($event) use ($day) {
        return date('d-m-Y', strtotime($event->DTSTART)) == $day;
    }) as $event)
                        @php($summary = explode(' - ', $event->SUMMARY))
                        @php($color = 'lightgrey')
                        <div style="margin-bottom: 10px; background-color: {{ $color }}">
                            <div class="row" style="height: 40px">
                                <div class="col-md-6">{{ $summary[1] }}</div>
                                <div class="col-md-6" style="text-align: right">{{ $summary[0] }}</div>
                            </div>
                            <div class="row" style="height: 40px">
                                <div class="col-md-6">{{ $summary[2] }}</div>
                                <div class="col-md-6" style="text-align: right">
                                    {{ date('H:m', strtotime($event->DTSTART)) }}</div>
                            </div>
                            @php
                                $class = 'btn-info';
                                if ($summary[1] == 'vwo6.loc') {
                                    $class = 'btn-warning';
                                }
                            @endphp
                            <button class="btn btn-sm {{ $class }}" style="margin: 10px; margin-top: 0">
                                <i class="fas fa-question-circle"></i>
                            </button>
                        </div>
                    @endforeach --}}
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
                                @if ($event['button_disabled']) disabled @endif
                                href="{{ URL::signedRoute('schedule.request', ['timestamp' => strtotime($event['details']->DTSTART), 'vak' => $event['vak']]) }}">
                                <i class="fas fa-question-circle"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>

        {{-- <table class="table">
            <tr>
                @foreach ($days as $day)
                    <th>{{ $day }}</th>
                @endforeach
            </tr>
            @for ($i = 1; $i <= 9; $i++)
                <tr>
                    <td>{{ $i }}</td>
                </tr>
            @endfor
        </table> --}}
    </div>
@endsection
