{{-- $name --}}
{{-- $type --}}
{{-- $value --}}
{{-- $required ? --}}
{{-- $attrs ? ['key': 'value'] --}}
{{-- $regex ? --}}
{{-- $id_prefix ? --}}
<input
    type="{{ $sub_type ?? $type }}"
    name="{{ $name }}"
    id="{{ $id  }}"
    @if(!empty($required))
        required
    @endif
    @include('partial.form.partial-input-attrs', ['attrs' => $attrs])
    @if(!empty($regex))
        data-validation="{{ $regex }}"
    @endif
    value="{{ $value }}"
>
