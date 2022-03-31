<div {{ $attributes->merge(['class' => 'modal fade ']) }} class="" id="{{$id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$title}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {{$slot}}
            </div>
            @if(null!==$footer)
            <div class="modal-footer">
{{--                <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('Cancel')}}</button>--}}
{{--                <a class="btn btn-primary" href="login.html">Logout</a>--}}
                {{$footer}}
            </div>
            @endif
        </div>
    </div>
</div>
