@extends('layouts.app')
@section('content')
<ul>
    @forelse($gerichte as $gericht)
      {{$gericht->name}}:{{$gericht->preis_intern}} <br>
    @empty
        Keine Gerichte vorhanden
    @endforelse
</ul>
    
@endsection