@extends('layouts.app')

@section('content')

<p></p>

<p class="pt-8">status: {!! $subject->state !!}</p>

@if($subject->image)
    <div class="pt-8">
        <img src="{{ asset($subject->image) }}" class="rounded w-100a" alt="{{ $subject->title }}">
        <br>
        <a href="{{ route('admin-subject-remove-image', ['subject' => $subject]) }}">verwijder afbeelding</a>
    </div>
@endif

<h5 class="pt-8 leading-7 font-semibold">{{ $subject->title }}</h5>

<p class="pt-8">{!! $subject->description !!}</p>

@if($subject->suggestion)
    <p class="pt-8">
        <button class="btn btn-primary" data-toggle="modal" data-target="#fromSubjectSuggestionModal">Oorspronkelijk ingestuurde onderwerp</button>
    </p>

@include('modals.admin.subject_suggestions.show', ['subject_suggestion' => $subject->suggestion])
@endif

@if($editable)
    @include('modals.admin.subject.edit', ['subject' => $subject])
    <p class="pt-8">
        <button class="btn btn-primary" data-toggle="modal" data-target="#editSubjectModal">Bewerken</button>
    </p>
    @if($claimed)
        <p class="pt-8">
            <a href="{{ route('admin-subject-claim-release', ['subject' => $subject]) }}" class="btn btn-primary">Claim loslaten</a>
        </p>
        @if($subject->state === 'draft')
            @include('modals.admin.subject_suggestions.accept', ['subject_suggestion' => $subject->suggestion])
            @include('modals.admin.subject_suggestions.reject', ['subject_suggestion' => $subject->suggestion])
            <p class="pt-8">
                <button class="btn btn-primary" data-toggle="modal" data-target="#acceptSubjectSuggestionModal">Keur goed</button>
                <button class="btn btn-primary" data-toggle="modal" data-target="#rejectSubjectSuggestionModal">Keur af</button>
            </p>
        @endif
    @endif
@elseif($claimed)
    is reeds geclaimed door {{ $claimUser->name }}
@endif

@if($claimable)
    <p class="pt-8">
        <a href="{{ route('admin-subject-claim', ['subject' => $subject]) }}" class="btn btn-primary">Claim</a>
    </p>
@endif

    <div class="pt-8 sm:justify-start">
        <a href="{{ route('admin-subject-index') }}" class="btn btn-secondary">Terug naar het overzicht</a>
    </div>

@endsection
