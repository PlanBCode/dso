{{-- $name --}}
{{-- $options [{value: 'value', selected: 'selected', label: 'label', attrs?: [{key: 'key', value: 'value'}]] --}}
{{-- $id_prefix ? --}}
{{-- $attrs ? ['key': 'value'] --}}
@foreach($options as $option)
<label
    for="{{ $option['id'] }}"
    class="radio-inline"
>
    <input
        type="radio"
        id="{{ $option['id'] }}"
        name="{{ $name }}"
        value="{{ $option['value'] }}"

        @if($option['selected'])
        checked
        @endif
        @include('partial.form.partial-input-attrs', ['attrs' => $attrs])
    >
    {{ $option['label'] }}
</label>
@endforeach
