@extends('layouts.app')

@section('content')
    <!-- Eingabemöglichkeiten für ein Wunschgericht-->
    <form method="POST" action="/sendWunschgericht">
        @csrf
        <div id="firstRow">
            <input class="wunschgericht_smallinput " type="text" name="name" placeholder="name">
            <input class="wunschgericht_smallinput" type="text" name="email" placeholder="email">
            <input class="wunschgericht_smallinput" type="text" name="gerichtname" placeholder="Gerichtname">
        </div>
        <div class="secondRow">
            <textarea rows="20" class="wunschgericht_biginput" name="beschreibung" placeholder="Beschreibung"></textarea>
            <button type="submit" name="submit" class="wunschgericht_submit">Speichern</button>
        </div>
        <div class="thirdRow">
        </div>


    </form>
@endsection
