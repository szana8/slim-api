<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    <label for="{{ $name }}" class="control-label">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $id }}" class="{{ $class }}" {{ $attributes }}>
        @foreach($options as $option)
            <option value="{{ $option->value }}"
            @if(old($name) != null && old($name) == $option->value)
                selected
            @elseif(isset($value) && $value == $option->value)
                selected
            @endif
            >{{ $option->label ? : $option->value }}</option>
        @endforeach
    </select>
    @if ($errors->has($name))
        <span class="help-block">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
    @endif
</div>