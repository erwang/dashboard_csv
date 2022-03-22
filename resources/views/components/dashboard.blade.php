<x-card id="dashboard" class="menu-panel">
    <x-slot name="title">
        <span style="padding-right: 1em">
            {{__('Dashboard')}}
        </span>
{{--        <a class="btn btn-outline-secondary btn-sm " href="">--}}
{{--            <i class="fa fa-envelope"></i>--}}
{{--        </a>--}}

        <div type="button" class="btn" data-toggle="popover" title="{{__('Disclaimer')}}" data-content="{{__('Warning: anyone with the link may be able to access the contents of the spreadsheet used.')}}">
            <a href="{{ URL::current() }}">{{__('Sharing link')}}</a>
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
        </div>

{{--        <a class="btn btn-outline-secondary btn-sm">--}}
{{--            <i class="fa fa-link"></i>--}}
{{--        </a>--}}

{{--        <a class="btn btn-outline-secondary btn-sm " href="https://twitter.com/intent/tweet?text={{urlencode(__('Mon dernier dashboard : ')).URL::current()}}" target="_blank">--}}
{{--            <i class="fab fa-twitter"></i>--}}
{{--        </a>--}}
    </x-slot>
    <x-slot name="tools">

        <span class="dropdown">
            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownAddGraph" data-toggle="dropdown" aria-expanded="false">
                {{ __('Add a chart') }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownAddGraph">
                <li><a class="dropdown-item" href="{{route('addGraph','timeline')}}">{{__('Timeline')}}</a></li>
                <li><a class="dropdown-item" href="{{route('addGraph','histogramme')}}">{{__('Lignes')}}</a></li>
                <li><a class="dropdown-item" href="{{route('addGraph','doughnut')}}">{{__('Doughnut')}}</a></li>
            </ul>
        </span>
    </x-slot>

    <div class="row">
    @foreach($data->graphs as $graph)
        @if(isset($graph->type))
        <x-dynamic-component :component="'graph.'.$graph->type ?? 'timeline'" :sheet="$sheet" :graph="$graph">
        </x-dynamic-component>
        @else
            @dd($graph)
        @endif
    @endforeach
    </div>

</x-card>
