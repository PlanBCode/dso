@extends('layouts.app')

@section('content')

<div class="pt-8 sm:justify-start pb-4">
    <a href="{{ route('home') }}" class="btn btn-secondary">Terug naar het overzicht</a>
</div>

@include('subjects.detail', ['subject' => $subject])

<div class="pt-8 sm:justify-start justify-center">
    @if($previous)
    <a href="{{ route('subject-show', ['subject' => $previous]) }}" class="btn btn-primary">Naar het vorige onderwerp</a>
    @else
    <a href="" class="btn btn-primary disabled">Naar het vorige onderwerp</a>
    @endif
    @if($next)
    <a href="{{ route('subject-show', ['subject' => $next]) }}" class="btn btn-primary">Naar het volgende onderwerp</a>
    @else
    <a href="" class="btn btn-primary disabled">Naar het volgende onderwerp</a>
    @endif
</div>

@endsection
