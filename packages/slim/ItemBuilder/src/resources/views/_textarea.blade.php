<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    <label for="{{ $name }}" class="control-label">{{ $label }}</label>
    <textarea rows="{{ $rows }}" name="{{ $name }}" id="{{ $id }}" class="{{ $class }}" {{ $attributes }}>{{ old($name) ? old($name) : ($value ? : "") }}</textarea>
    @if ($errors->has($name))
        <span class="help-block">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>