{{-- $attrs ? ['key': 'value'] --}}
@if(!empty($attrs))
    @foreach($attrs as $attrKey => $attrValue)
        @if(empty($attrKey))
            {!! $attrValue !!}
        @else
            {{ $attrKey }}="{!! $attrValue !!}"
        @endif
    @endforeach
@endif
