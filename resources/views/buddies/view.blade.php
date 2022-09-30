@extends('inc.app')
{{$page_id="buddies"}}

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Buddie details</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('buddies')}}">Buddies</a></li>
        <li class="breadcrumb-item active">{{$buddie->user->name}}</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user me-1"></i>
            Persoonlijke gegevens
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-4">
                        <label for="name">Naam</label>
                        <input class="form-control" type="text" id="name" value="{{$buddie->user->name}}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="leerlingnummer">Leerlingnummer</label>
                        <input class="form-control" type="text" id="leerlingnummer" value="{{$buddie->leerlingnummer}}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="klas">Klas</label>
                        <input class="form-control" type="text" id="klas" value="{{$buddie->klas}}" readonly>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="email">Email adres</label>
                        <input class="form-control" type="text" id="email" value="{{$buddie->user->email}}" readonly>
                    </div>
                </div>
            </form>
        </div>
        {{-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> --}}
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-users"></i>
                    Gekoppelde leerlingen
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Naam</th>
                            <th>Leerlingnummer</th>
                            <th>Klas</th>
                        </tr>
                        @foreach($buddie->leerlingen as $leerling)
                        <tr>
                            <td>
                                <a class="btn-link" href="#">
                                {{$leerling->user->name}} <i class="fas fa-arrow-up-right-from-square"></i>
                                </a>
                            </td>
                            <td>{{$leerling->leerlingnummer}}</td>
                            <td>{{$leerling->klas}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection