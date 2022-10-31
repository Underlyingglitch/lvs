@extends('inc.app')
@php($page_id = 'schedule')

@section('title', 'Rooster instellen')

@section('content')
    <div class="container-fluid px-4">
        <div id="overlay"
            style="position: fixed;display: block;width: 100%;height: 100%;top: 0;left: 0;right: 0;bottom: 0;background: linear-gradient(45deg, #000000 25%, #ff0000 25%, #ff0000 50%, #000000 50%, #000000 75%, #ff0000 75%, #ff0000 100%);background-size: 56.57px 56.57px;opacity:80%;z-index: 2;">
            <div
                style="position: absolute;top: 50%;left: 50%;font-size: 50px;color: white;transform: translate(-50%,-50%);-ms-transform: translate(-50%,-50%);">
                Functionaliteit uitgeschakeld
            </div>
        </div>
        <h1 class="mt-4">Rooster instellen</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Rooster</li>
            <li class="breadcrumb-item active">Instellen</li>
        </ol>

        Om gebruik te kunnen maken van de rooster functie moet je jouw SomToday rooster koppelen. Volg hiervoor de stappen
        onderaan deze pagina en vul de verkregen URL in dit vak in:<br>
        <form action="{{ route('schedule.post') }}" method="post">
            @csrf
            <input class="form-control" type="text" name="url" placeholder="URL"><br>
            <input class="btn btn-primary" type="submit" value="Opslaan">
        </form>

        <hr>
        <h4>Instructie</h4>
        <ol>
            <li>Log in op de <a class="btn-link" href="https://somtoday.nl"><b>website</b> van SomToday</a></li>
            <li>Klik rechtsboven op je eigen naam</li>
            <li>Scroll helemaal naar beneden en klik op <u>Genereer iCalendar-token</u></li>
            <li>Kopieer zorgvuldig deze link in bovenstaand veld en klik op Opslaan</li>
        </ol>

        <div class="alert alert-warning">
            <b>Disclaimer</b><br>
            Deze link geeft toegang tot je rooster en enkel je rooster. Deel deze link dus enkel met mensen waarvan je het
            geen probleem vindt als ze je rooster hebben. Dit systeem gebruikt deze data zodat je vrijstelling kunt
            aanvragen voor lessen en controleert op deze manier of dit toegestaan is. Uiteindelijk is deze beslissing altijd
            aan de docent.
        </div>
    </div>
@endsection
