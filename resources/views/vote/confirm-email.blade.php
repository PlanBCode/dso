@extends('layouts.app')

@section('content')
<div class="pt-8 sm:justify-start">
    <h3>Dankjewel voor je stem!</h3>
    @if($overwrite)
        <p>Je hebt al eerder een stem uitgebracht. Omdat je één keer per stemronde een onderwerp kunt kiezen, telt alleen je meest recente stem. Je vorige stem is hiermee dus komen te vervallen.</p>
    @else
        <p>Over twee weken weten we welk onderwerp de meeste stemmen heeft gekregen en welk onderwerp dus onderzocht gaat worden door de Stadsbron. We houden je op de hoogte wanneer het zover is! Je krijgt dan automatisch een mailtje.</p>
    @endif
</div>

<div class="pt-8 sm:justify-start">
    <a href="{{ route('projects') }}" class="btn btn-primary">Onderwerpen bekijken</a>
</div>
@endsection
