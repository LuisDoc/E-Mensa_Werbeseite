@extends('layouts.app')

@section('content')
    <!-- Eingabemöglichkeiten für ein Wunschgericht-->

    @foreach ($errors->all() as $error)
        <?php Alert::error("Fehler",$error)?>;
    @endforeach
    <form method="POST" action="/sendWunschgericht">
        @csrf
        <div id="firstRow">
            <input class="wunschgericht_smallinput " type="text" name="name" placeholder="name" value="">
            <input class="wunschgericht_smallinput" type="text" name="email" placeholder="email" value="">
            <input class="wunschgericht_smallinput" type="text" name="gericht" placeholder="Gerichtname" value="">
        </div>
        <div class="secondRow">
            <textarea rows="20" class="wunschgericht_biginput" name="beschreibung" placeholder="Beschreibung"></textarea>
            <button type="submit" name="submit" class="wunschgericht_submit">Speichern</button>
        </div>
        <div class="thirdRow">
        </div>


    </form>
@endsection
