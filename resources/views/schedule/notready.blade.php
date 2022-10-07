@extends('inc.app')
@php($page_id = 'schedule')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Rooster</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Rooster</li>
        </ol>
        <i>Binnenkort kun je hier vrijstellingen regelen</i>
    </div>
@endsection
