@extends('layouts.app')

@section('content')
<div class="justify-center pt-8 mx-5 sm:justify-start">
    <h3>Admin</h3>
</div>

<div class="mt-8 bg-white {{ $darkPrefix }}bg-gray-800 overflow-hidden shadow sm:rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-4">
        <a href="{{ route('admin-subject-index') }}">
        <div class="p-6">
            <div class="flex items-center">
                <div class="text-lg leading-7 font-semibold">Onderwerpen</div>
            </div>

            <div class="">
                <div class="mt-2 text-gray-600 {{ $darkPrefix }}text-gray-400 text-sm">
                    Overzicht van alle onderwerpen
                </div>
            </div>
        </div>
        </a>

        <a href="{{ route('admin-assistant-index') }}" class="bg-transparent">
        <div class="p-6 border-t {{ $darkPrefix }}border-gray-700 md:border-t-0 md:border-l">
            <div class="flex items-center">
                <div class="text-lg leading-7 font-semibold">Researchers</div>
            </div>

            <div class="">
                <div class="mt-2 text-gray-600 {{ $darkPrefix }}text-gray-400 text-sm">
                    Mensen die willen helpen met het onderzoek
                </div>
            </div>
        </div>
        </a>

        <a href="{{ route('admin-voting-round-index') }}" class="bg-transparent">
        <div class="p-6 border-t {{ $darkPrefix }}border-gray-700 md:border-t-0 md:border-l">
            <div class="flex items-center">
                <div class="text-lg leading-7 font-semibold">Stemrondes</div>
            </div>

            <div class="">
                <div class="mt-2 text-gray-600 {{ $darkPrefix }}text-gray-400 text-sm">
                    Beheer de stemrondes
                </div>
            </div>
        </div>
        </a>

        <a href="{{ route('admin-update-application') }}" class="bg-transparent">
        <div class="p-6 border-t {{ $darkPrefix }}border-gray-700 md:border-t-0 md:border-l">
            <div class="flex items-center">
                <div class="text-lg leading-7 font-semibold">Update</div>
            </div>

            <div class="">
                <div class="mt-2 text-gray-600 {{ $darkPrefix }}text-gray-400 text-sm">
                    Warning: Updates the application, use with care!
                </div>
            </div>
        </div>
        </a>

    </div>
@endsection
