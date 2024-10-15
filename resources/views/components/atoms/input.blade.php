<input 
    type="{{ $type }}" 
    name="{{ $name }}" 
    id="{{ $id }}" 
    value="{{ $value }}" 
    placeholder="{{ $placeholder }}" 
    autocomplete="{{ $autocomplete }}" 
    @if($required) required @endif
    @if($ariaRequired) aria-required="true" @endif
    class="{{ $styleClasses }}"
/>
