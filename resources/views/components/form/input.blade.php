@props(['name', 'label' => null , 'placeholder'=>'', 'type' => 'text', 'oldVal' => ''])
<div class="">
    @if ($label)
        <label for="{{ $name }}" class="form-label"> {{ $label }} </label>
    @endif
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
        value="{{ $oldVal }}" class="form-control" {{ $attributes }}>
</div>
