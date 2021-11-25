@extends('layouts.app')

@section('content')
    <div class="SortBar">
        <button><a class="dropdown-item" href="/showNewsletterAdmin/NameAsc">Name aufsteigend</a></button>
        <button><a class="dropdown-item" href="/showNewsletterAdmin/EmailAsc">Email aufsteigend</a></button>

        <form class="searchForm" method="post" action="/showNewsletterAdmin/search">
            @csrf
            <input class="searchFormInputField" type="search" name="searchText" placeholder="Filtern nach"
                aria-label="Search">
            <button class="searchFormSubmit" type="submit">Submit</button>
        </form>
    </div>

    <div class="adminPanelNewsletterTable">
        <table id="anmeldungen">
            <thead>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Sprache</th>
                <th>Datenschutz</th>
            </thead>
            <tbody>
                @foreach ($Registrations as $anmeldung)
                    <tr>
                        <td>{{ $anmeldung->username }}</td>
                        <td>{{ $anmeldung->email }}</td>
                        <td>{{ $anmeldung->language }}</td>
                        <td>Checked</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection
