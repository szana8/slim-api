<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    <label for="{{ $name }}" class="control-label">{{ $label }}</label>
    <input type="date" name="{{ $name }}" id="{{ $id }}" class="{{ $class }}"
           value="{{ old($name) ? old($name) : ($value ? : "") }}" {{ $attributes }} />
    @if ($errors->has($name))
        <span class="help-block">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
    @endif
</div>