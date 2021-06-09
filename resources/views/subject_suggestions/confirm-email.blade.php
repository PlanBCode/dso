@extends('layouts.app')

@section('content')
<div class="pt-8 sm:justify-start">
    <h3>Dank je wel voor het bevestigen van jouw e-mail</h3>
    <p>De redactie gaat je onderwerp lezen om te kijken of het past bij de Stadsbron: of het lokaal is, onderzoek nodig heeft, voor meerdere mensen interessant is en te onderzoeken lijkt. Als dat zo is, verschijnt het op de website.</p>
</div>

<div class="pt-8 sm:justify-start">
    <a href="{{ route('home') }}" class="btn btn-primary">Andere onderwerpen bekijken</a>
</div>
<div class="pt-8 sm:justify-start">
    <a href="{{ route('subject-suggestion-create') }}" class="btn btn-primary">Ik wil nog een onderwerp insturen</a>
</div>
@endsection
