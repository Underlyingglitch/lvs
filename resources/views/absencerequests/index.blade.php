@extends('inc.app')
@php($page_id = 'absencerequests')

@section('title', 'Verzuimverzoeken')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Verzuimverzoeken</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Verzuimverzoeken</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Overzicht verzoeken
            </div>
            <div class="card-body">
                <table id="dataTable" class="table table-striped table-bordered" style="display:none">
                    <thead>
                        <tr>
                            <th>Leerlingnummer</th>
                            <th>Naam</th>
                            <th>Klas</th>
                            <th>Datum + lesuur</th>
                            <th>Vak</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Leerlingnummer</th>
                            <th>Naam</th>
                            <th>Klas</th>
                            <th>Datum + lesuur</th>
                            <th>Vak</th>
                            <th>Acties</th>
                        </tr>
                    </tfoot>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
