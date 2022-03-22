<div class="form-group">
    <label for="{{$name}}">{{ __($label) }}</label>
    <select name="{{$name}}" id="{{$name}}" {{$attributes->merge(['class'=>'form-select form-control'])}} >
        @if($empty??false)
            <option value="">--</option>
        @endif
        @foreach($options as $key=>$option)
            @if(in_array($key,$value))
                <option value="{{$key}}" selected="selected">{{$option}}</option>
            @else
                <option value="{{$key}}">{{$option}}</option>
            @endif
        @endforeach
    </select>
</div>
