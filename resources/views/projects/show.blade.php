@extends('inc.app')
@php($page_id = 'projects')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">
            {{ $project->name }}
        </h1>
        @can('projects.view')
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projecten</a></li>
                <li class="breadcrumb-item active">Project #{{ $project->id }}</li>
            </ol>
        @else
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Project details</li>
            </ol>
        @endcan
    </div>
@endsection
