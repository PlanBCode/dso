{{-- $name --}}
{{-- $options [{value: 'value', selected: 'selected', label: 'label', attrs?: [{key: 'key', value: 'value'}]] --}}
{{-- $id_prefix ? --}}
{{-- $attrs ? ['key': 'value'] --}}
@foreach($options as $option)
@if (!empty($option['label']))
<label for="{{ $option['id'] }}" class="checkbox-inline">
@endif
    <input
        type="checkbox"
        id="{{ $option['id'] }}"
        name="{{ $name }}"
        value="{{ $option['value'] }}"

        @if($option['selected'])
        checked
        @endif
        @include('partial.form.partial-input-attrs', ['attrs' => $attrs])
    >

@if (!empty($option['label']))
    {{ $option['label'] }}
</label>
@endif
@endforeach
