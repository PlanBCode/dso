@extends('layouts.app')

@section('content')
<div class="pt-8 sm:justify-start">
    <h3>Dankjewel, we hebben je stem of je aanmelding ontvangen.</h3>
    <p>Ben je benieuwd welk onderwerp de Stadsbron uiteindelijk gaat onderzoeken? Tot en met 22 mei kan er gestemd worden en op 23 mei weten we welk onderwerp gekozen is. Je krijgt dan een mailtje van ons.</p>
</div>

<div class="pt-8 sm:justify-start">
    <a href="{{ route('main') }}" class="btn btn-primary">Onderwerpen bekijken</a>
</div>
@endsection
