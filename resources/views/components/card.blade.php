<div {{ $attributes->merge(['class' => 'card mb-4 '.($class ?? '')]) }}>
    @if($title!='')
    <div class="card-header">
        {{$title}}
        @if($tools!==false)
            <span class="float-right">
                {{$tools}}
            </span>
        @endif
    </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
