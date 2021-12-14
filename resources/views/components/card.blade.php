<div {{ $attributes->merge(['class' => 'card mb-4 '.($class ?? '')]) }}>
    @if($title!='')
    <div class="card-header">
        {{$title}}
    </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
