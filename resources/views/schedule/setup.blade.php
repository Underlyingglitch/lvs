@extends('inc.app')
{{ $page_id = 'schedule' }}

@section('content')
    <div class="container-fluid px-4">
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
