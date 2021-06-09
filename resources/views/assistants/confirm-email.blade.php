@extends('layouts.app')

@section('content')
<div class="pt-8 sm:justify-start">
    <h3>Dank je wel voor het bevestigen van jouw e-mail</h3>
</div>

<div class="pt-8 sm:justify-start">
    <a href="{{ route('home') }}" class="btn btn-primary">Onderwerpen bekijken</a>
</div>
@endsection
