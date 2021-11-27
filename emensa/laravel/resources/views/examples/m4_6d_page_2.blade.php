@extends('layouts.m4_6d_layout')

@section('title')
    <title>Page 2</title>
@endsection

@section('header')
    <section>
        <!-- Basic Grid für Navigationsleiste und Titelbild links-->
        <div class="header">
            <div class="header_left_picture">
                <a href="/">
                    <!-- Logo Verlinkt zur LandingPage-->
                    <img class="fh_logo" src="{{ asset('sources/Logo_FH-Aachen.jpg') }}" alt="logo">
                </a>

            </div>
            <!--Inneres Grid für Menupunkte -->
            <div class="header_menu_reiter">
                <a href="/#Ankündigungen" class="header_links">Ankündigung</a>
                <a href="/#Speisekarte" class="header_links">Speisen</a>
                <a href="/#Zahlen" class="header_links">Zahlen</a>
                <a href="/#Newsletter" class="header_links">Kontakt</a>
                <a href="/#Wichtig" class="header_links">Wichtig für Uns</a>
            </div>
        </div>
    </section>
@endsection

@section('main')
    <div class="card">
    <img src="https://picsum.photos/300" alt="Avatar">
        <div class="container">
            <h4><b>Lorem Ipsum Page 2</b></h4> 
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, accusamus.</p> 
        </div>
    </div>
@endsection


@section('footer')
    <footer id="footer">
            <div class="foot">
                <nav>
                    <span class="footer_links">
                        <a class="affiliates" href="#">(c) e mensa GmbH</a>
                        <a class="affiliates" href="#"> Do Carmo,&nbsp;&nbsp;Liyanaarachchi </a>
                        <a class="affiliates" href="#">Impressum</a>
                    </span>
                    <span class="social">
                        <a href="#"><img class="icon" src="sources/facebook.png" alt="facebook"></a>
                        <a href="#"><img class="icon" src="sources/googlep.png" alt="googleplus"></a>
                        <a href="#"><img class="icon" src="sources/linkedIn.png" alt="linkedIn"></a>
                        <a href="#"><img class="icon" src="sources/twitter.png" alt="twitter"></a>
                    </span>
                </nav>
            </div>
    </footer>
@endsection