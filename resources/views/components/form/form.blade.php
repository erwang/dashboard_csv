<form action="{{$action}}" method="POST">
    @csrf
    {{$slot}}
    <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
</form>
