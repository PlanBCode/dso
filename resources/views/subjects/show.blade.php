@extends('layouts.app')

@section('content')

<div class="pt-8 sm:justify-start">
    <a href="{{ route('projects') }}" class="btn btn-secondary">Terug naar het overzicht</a>
</div>

<div class="pt-8">
    <img src="{{ asset($subject->image) }}" class="rounded w-100a" alt="{{ $subject->title }}">
</div>

<h5 class="pt-8 leading-7 font-semibold">{{ $subject->title }}</h5>

<p class="pt-8">{!! $subject->description !!}</p>

{{--<p class="pt-8">--}}
{{--    Dit onderwerp is samengesteld uit verschillende inzendingen.<br>--}}
{{--    <button href="{{ route('projects') }}" class="btn btn-primary" data-toggle="modal" data-target="#subjectsModal">Bekijk ze hier</button>--}}
{{--</p>--}}

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

<!-- Modal -->
{{--<div class="modal fade" id="subjectsModal" tabindex="-1" aria-labelledby="subjectsModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-xl modal-dialog-scrollable">--}}
{{--        <div class="modal-content bg-gray-200">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="subjectsModalLabel">Oorspronkelijke ingestuurde onderwerpen</h5>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body bg-white">--}}
{{--                <ul class="pl-0 mt-3 mx-5">--}}
{{--                    @foreach($subject->suggestions as $index => $suggestion)--}}
{{--                        {{ ($index + 1) }}--}}
{{--                        <div class="border p-6 shadow-sm">--}}
{{--                            <b>Titel:</b><br>--}}
{{--                            <span data-summary="name">{{ $suggestion->title }}</span><br>--}}
{{--                            <br>--}}
{{--                            <b>Beschrijving onderwerp:</b><br>--}}
{{--                            <span data-summary="description">{{ $suggestion->description }}</span><br>--}}
{{--                            <br>--}}
{{--                            <b>Dit moet onderzocht worden omdat:</b><br>--}}
{{--                            <span data-summary="importance">{{ $suggestion->importance }}</span><br>--}}
{{--                            <br>--}}
{{--                            <b>Bronnen bij dit onderwerp:</b><br>--}}
{{--                            <div class="container">--}}
{{--                                @foreach($suggestion->files as $file)--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-1">--}}
{{--                                            @if($file->isImage())--}}
{{--                                                <img src="{{ asset($file->file_path) }}" style="width: inherit;">--}}
{{--                                            @else--}}
{{--                                                <div class="border p-2 border-primary">{{ $file->getExtension() }}</div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                        <div>--}}
{{--                                            {{ $file->name }}<br>--}}
{{--                                            <a href="{{ asset($file->file_path) }}" download>download</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <div class="modal-footer"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
