@extends('layouts.app')

@section('content')

    <div class="pt-8">
        <b>Email:</b><br>
        <span>{{ $assistant->email }}</span><br>
        <br>
        <b>Weet hoe ik wil mee helpen:</b><br>
        <span>{{ $assistant->know_what_to_do ? 'ja' : 'nee' }}</span><br>
        <br>
        <b>Dit is wat ik wil doen:</b><br>
        <span>{{ $assistant->what_to_do }}</span><br>
    </div>

    <div class="pt-8 sm:justify-start">
        <a href="{{ route('admin-assistant-index') }}" class="btn btn-secondary">Terug naar het overzicht</a>
    </div>

@endsection
