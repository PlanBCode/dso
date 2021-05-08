{{-- $name --}}
{{-- $options [{value: 'value', selected: 'selected', label: 'label'] --}}
{{-- $required ? --}}
{{-- $attrs ? ['key': 'value'] --}}
{{-- $id_prefix ? --}}
<select
    name="{{ $name }}"
    id="{{ $id }}"
    @if(!empty($required))
        required
    @endif
    @include('partial.form.partial-input-attrs', ['attrs' => $attrs])
>
@foreach($options as $option)
    <option
        value="{{ $option['value'] }}"
        @if($option['selected'])
            selected
        @endif
    >
    {{ $option['label'] }}
    </option>
@endforeach
</select>
