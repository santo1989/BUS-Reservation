@props(['name', 'label' ,'value'])


<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <textarea class="form-control" name="{{ $name }}" id="{{ $name }}" rows="3">{{ $value }}</textarea>
  </div>