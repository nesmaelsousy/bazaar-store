@props(['name', 'label'=>null,  'type' => 'text', 'oldVal' => '','options'=>'','firstOne'=>''])
@if($label)
    <label for="" class="form-label">{{ $label }}</label>
    
@endif
<select name="{{ $name }}" id="{{ $name }}" class="form-control">
    <option value="">{{ $firstOne }}</option>
    @foreach ($options as $value => $label)
      <option value="{{ $value }}" {{  old($name, $oldVal) == $value ? 'selected' : '' }}>{{ $label }}</option>  
    @endforeach
    
</select>