@extends('layouts.app')
@section('content')
<ul>
    @foreach($kategorien as $kategorie)
        @if($loop->even)
            <li style="font-weight:bold;list-style-type:none;">{{$kategorie->name}}</li>
        @elseif($loop->odd)
            <li style="list-style-type:none;">{{$kategorie->name}}</li>
        @endif
    @endforeach
</ul>
    
@endsection