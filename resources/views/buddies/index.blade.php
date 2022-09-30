@extends('inc.app')
{{$page_id="buddies"}}

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Buddies</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Buddies</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Overzicht buddies
        </div>
        <div class="card-body">
            <table id="dataTable" style="display:none">
                <thead>
                    <tr>
                        <th>Leerlingnummer</th>
                        <th>Naam</th>
                        <th>Email</th>
                        <th>Leerlingen</th>
                        <th>Status</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Leerlingnummer</th>
                        <th>Naam</th>
                        <th>Email</th>
                        <th>Leerlingen</th>
                        <th>Status</th>
                        <th>Acties</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($buddies as $buddie)
                    <tr>
                        <td>{{$buddie->leerlingnummer}}</td>
                        <td>{{$buddie->user->name}}</td>
                        <td>{{$buddie->user->email}}</td>
                        <td>{{$buddie->leerlingen->count()}}</td>
                        <td>
                            @if(strtotime($buddie->user->last_seen) > strtotime("-1 minutes"))
                                <span class="text-success">Online</span> 
                            @else
                                <span class="text-secondary">{{Carbon\Carbon::parse($buddie->user->last_seen)->diffForHumans()}}</span> 
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-sm btn-info" href="{{route('buddies.view', ['id' => $buddie->id])}}"><i class="fas fa-info"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection