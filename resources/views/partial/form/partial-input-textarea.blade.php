{{-- $name --}}
{{-- $value --}}
{{-- $attrs ? ['key': 'value'] --}}
{{-- $id_prefix ? --}}
<textarea
    name="{{ $name }}"
    id="{{ $id }}"
    @include('partial.form.partial-input-attrs', ['attrs' => $attrs])
>{{ $value }}</textarea>
