<select name="{{$name}}" id="{{$name}}" {{$attributes->merge(['class'=>'form-select form-control'])}}>
    @if($empty??false)
        <option value="-">--</option>
    @endif
    {{$slot}}
</select>
