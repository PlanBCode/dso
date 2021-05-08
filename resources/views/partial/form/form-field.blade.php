<div class="form-group {{ $field['id'] }}@error($field['name']) is-invalid @enderror">
    @if(!empty($field['label']))
        <label class="type-{{ $field['type'] }}{{ isset($field['sub_type']) ? ' type-'.$field['sub_type'] : '' }}" for="{{ $field['id'] }}">{!! $field['label'] !!}@if(!empty($field['required'])) *@endif</label>
    @endif

    @if(!empty($field['addon']))
        <div class="input-group">
    @endif
    @if($field['type'] == 'text')
        @include('partial.form.partial-input-text', $field)
    @elseif($field['type'] == 'textarea')
        @include('partial.form.partial-input-textarea', $field)
    @elseif($field['type'] == 'select')
        @include('partial.form.partial-input-select', $field)
    @elseif($field['type'] == 'radio')
        @include('partial.form.partial-input-radio', $field)
    @elseif($field['type'] == 'checkbox')
        @include('partial.form.partial-input-checkbox', $field)
    @endif
    @if(!empty($field['addon']))
            <span class="input-group-addon">{!! $field['addon'] !!}</span>
        </div>
    @endif
    @if(!empty($field['comment']))
        <div><small>{!! $field['comment'] !!}</small></div>
    @endif

    @error($field['name'])
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
