@extends('inc.app')

@php($page_id = 'dashboard')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        Dashboard in ontwikkeling. Vergeet niet om je wachtwoord te veranderen nadat je voor het eerst hebt ingelogd. Klik
        daarvoor op het profiel icoontje rechtsboven in het scherm. Voor vragen, neem contact op met
        st126151@leerling.stellamariscollege.nl
    @endsection
