@extends('layouts.app')

@section('content')
    <!-- Eingabemöglichkeiten für ein Wunschgericht-->

    @foreach ($errors->all() as $error)
        <?php Alert::error('Fehler', $error); ?>;
    @endforeach
    <form class="" method="POST" action="/sendWunschgericht">
        @csrf
        <div class="wunschgericht_form">
            <input type="text" name="name" placeholder="name" value="">
            <input type="text" name="email" placeholder="email" value="">
            <input type="text" name="gericht" placeholder="Gerichtname" value="">
            <textarea rows="3" class="wunschgericht_biginput" name="beschreibung" placeholder="Beschreibung"></textarea>
            <button type="submit" name="submit" class="wunschgericht_submit">Absenden</button>
        </div>
    </form>
@endsection
