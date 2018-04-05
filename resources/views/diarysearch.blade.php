<!-- View for the home page -->
@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">

          <!-- check to see if the user has verified their enmailadres -->
            @if (!(auth()->user()->verified()) && !(auth()->user()->reader()))
            <!-- else user is gebruiker en heeft nog niet geverificeerd -->
            <div class="alert alert-danger">
              <br /><strong>
                Hartelijk dank voor uw registratie!<br />
                Voor u verder kunt gaan, moet u uw email verificeren. <br />
                Bekijk uw email om uw account te activeren.
                    </strong>
            </div>

            @elseif (auth()->user()->verified())
              @if (session('succes'))
                      <div class="alert alert-success">
                          {{ session('succes') }}
                      </div>
              @endif

            <h5><center>Zoekfuncties</center></h5>
          </div>
          <div class="card-body">
            <!-- Search function to search in events -->
            <form method="GET" action="{{ action('OverviewController@search') }}" >
                <input type="text" name="search" placeholder="Zoekopdracht">
                <button type="submit">Zoek in je dagboek</button>
            </form><br>

            <!-- sort function to sort by illness-->
            <form method="GET" id="illnessform" action="{{ action('OverviewController@sortillness') }}" >
            <select form= 'illnessform' name="illness" class="sort_illness">
                <option value="" selected disabled hidden>Kies ziekte</option>
              @foreach($illnesses as $illness)
                <option value="{{ $illness->illness }}">{{ $illness->illness }}</option>
              @endforeach()
            </select>
            <button type="submit">Sorteer je dagboek op ziekte</button>
            </form>
            <br>

            <!-- sort function to sort by intensity-->
            <form method="GET" id="intensityform" action="{{ action('OverviewController@sortintensity') }}" >
            <select form= 'intensityform' name="intensity" class="sort_intensity">
                <option value="" selected disabled hidden>Kies intensiteit</option>
              @foreach($entries as $entry)
                <option value="{{ $entry->intensity }}">{{ $entry->intensity }}</option>
              @endforeach()
            </select>
            <button type="submit">Sorteer je dagboek op intensiteit</button>
            </form>
            <br>

          <!-- result of searchfield -->
          @foreach($search as $entry)
            <div class="card">
              <div class="card-header">
              Ziekte:
              <b> {{ $entry -> illness }}</b>
              @if(!empty($entry->timespan_date))
                {{ __(', ')}}
                Datum: {{ $entry -> timespan_date }}
              @endif
            </div>
            <div class="card-body">
              Symptoom:
              @foreach($entry->symptomes as $symptom)
                {{ $symptom->symptom }}
                {{ __(', ')}}
              @endforeach
              <br>
              Intensiteit:
              {{ $entry->intensity }}
              <br>
              <em><a href="{{ route('entries.show', $entry->id) }}">Bekijk pagina</a></em>
              </div>
            </div>
            <br>
          @endforeach

          <!-- view if user has sort by illness -->
          @foreach($sortillness as $entry)
            <div class="card">
              <div class="card-header">
              Ziekte:
              <b> {{ $entry -> illness }}</b>
              @if(!empty($entry->timespan_date))
                {{ __(', ')}}
                Datum: {{ $entry -> timespan_date }}
              @endif
            </div>
            <div class="card-body">
              Symptoom:
              @foreach($entry->symptomes as $symptom)
                {{ $symptom->symptom }}
                {{ __(', ')}}
              @endforeach
              <br>
              Intensiteit:
              {{ $entry->intensity }}
              <br>
              <em><a href="{{ route('entries.show', $entry->id) }}">Bekijk pagina</a></em>
              </div>
            </div>
            <br>
          @endforeach

          <!-- result when user sorts on intensity -->
          @foreach($sortintensity as $entry)
            <div class="card">
              <div class="card-header">
              Ziekte:
              <b> {{ $entry -> illness }}</b>
              @if(!empty($entry->timespan_date))
                {{ __(', ')}}
                Datum: {{ $entry -> timespan_date }}
              @endif
            </div>
            <div class="card-body">
              Symptoom:
              @foreach($entry->symptomes as $symptom)
                {{ $symptom->symptom }}
                {{ __(', ')}}
              @endforeach
              <br>
              Intensiteit:
              {{ $entry->intensity }}
              <br>
              <em><a href="{{ route('entries.show', $entry->id) }}">Bekijk pagina</a></em>
              </div>
            </div>
            <br>
          @endforeach
          @endif
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
