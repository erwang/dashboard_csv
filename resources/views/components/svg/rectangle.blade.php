<rect width="{{$width}}" height="{{$height}}" x="{{$x ?? 0 }}" y="{{ $y ?? 0 }}" rx="5" ry="5" {{$attributes}}>
    {{$slot}}
    @if($tooltip??false)
        <title>{{$tooltip}}</title>
    @endif
</rect>

