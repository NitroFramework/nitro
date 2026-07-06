@if ($tag === 'input')
<input type="text" name="text" id="todo-input" placeholder="Add a new todo..." {!! $hxAttrs !!} @if($class) class="{{ $class }}" @endif />
@else
<{{ $tag }} type="button" @if($class) class="{{ $class }}" @endif {!! $hxAttrs !!}>
    {!! $slot !!}
</{{ $tag }}>
@endif