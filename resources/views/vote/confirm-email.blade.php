@extends('layouts.app')

@section('content')
<div class="pt-8 sm:justify-start">
    <h3>Dankjewel, we hebben je stem of je aanmelding ontvangen.</h3>
    <p>Ben je benieuwd welk onderwerp de Stadsbron uiteindelijk gaat onderzoeken? Zodra we weten welk onderwerp de meeste stemmen heeft gekregen krijg je een mailtje van ons.</p>
</div>

<div class="pt-8 sm:justify-start">
    <a href="{{ route('home') }}" class="btn btn-primary">Onderwerpen bekijken</a>
</div>
@endsection
