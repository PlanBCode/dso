@extends('layouts.app')

@section('content')

    <div class="pt-8">
        {!! $form->render() !!}

        <div class="pt-8 sm:justify-start">
            <a href="{{ route('admin-voting-round-index') }}" class="btn btn-secondary">Terug naar het overzicht</a>
        </div>
    </div>

@endsection
