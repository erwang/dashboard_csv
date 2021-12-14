<h1>{{ $sheet->cols[$data['column1']] }}</h1>
<x-svg.svg width="{{$width}}" height="{{$height}}">
    @foreach($lines as $value=>$line)
        <x-svg.group>
            <x-svg.text x="0" y="{{ $line->y+$lineHeight/2 }}">
                @if($value=='')
                    {{__('empty')}}
                @else
                    {{$value}}
                @endif
            </x-svg.text>
            <x-svg.line x1="{{$startLine}}" y1="{{$line->y+15}}" x2="{{$width-$margin}}" y2="{{$line->y+15}}" style="stroke:rgb(200,200,200);stroke-width:2"></x-svg.line>
            @foreach($line->areas as $area)
                <x-svg.rectangle x="{{max($area['x'],$margin)+$startLine}}" y="{{$area['y']}}" width="{{$area['width']-$margin}}" height="{{ $lineHeight/1.5 }}"
                                 style="fill:{{$area['color']}}"
                                 tooltip="{!! $area['description'] !!}"
                >

                </x-svg.rectangle>
                <x-svg.text x="{{max($area['x'],$margin)+$startLine+$margin}}" y="{{$line->y+$lineHeight/2-1}}" style="font-size: 0.6em">
                    {{$area['text']}}
                </x-svg.text>
            @endforeach
        </x-svg.group>
    @endforeach
    @if(count($distinctValuesColumn2)>0)
        <x-svg.group style="border: thin solid">
            @php
                $y = count($lines) * ($lineHeight+1)+$margin*3;
                $x0= $startLine;
            @endphp
            <x-svg.text x="{{$x0}}" y="{{$y}}">
                {{$sheet->cols[$data['column2']]}}
            </x-svg.text>
            @php $y+=$lineHeight+$margin; @endphp
            @foreach($distinctValuesColumn2 as $value=>$color)
                <x-svg.rectangle x="{{$x0}}" y="{{$y-$lineHeight}}" width="{{$lineHeight-$margin}}" height="{{$lineHeight-$margin}}" style="fill:{{$color}}"></x-svg.rectangle>
                <x-svg.text x="{{$x0 + $lineHeight+$margin}}" y="{{$y-$lineHeight/4}}">{{$value=='' ? __('empty') : $value}}</x-svg.text>
                @php $y+=$lineHeight; @endphp
            @endforeach
        </x-svg.group>
    @endif
    @if(count($distinctValuesColumn3)>0)
        <x-svg.group style="border: thin solid">
            @php
                $y = count($lines) * ($lineHeight+1)+$margin*3;
                $x0= $startLine+$width/3;
            @endphp
            <x-svg.text x="{{$x0}}" y="{{$y}}">
                {{$sheet->cols[$data['column3']]}}
            </x-svg.text>
            @php $y+=$lineHeight+$margin; @endphp
            @foreach($distinctValuesColumn3 as $value=>$color)
                <x-svg.rectangle x="{{$x0}}" y="{{$y-$lineHeight}}" width="{{$lineHeight-$margin}}" height="{{$lineHeight-$margin}}" style="fill:{{$color}}"></x-svg.rectangle>
                <x-svg.text x="{{$x0+ $lineHeight+$margin}}" y="{{$y-$lineHeight/4}}">{{$value=='' ? __('empty') : $value}}</x-svg.text>
                @php $y+=$lineHeight; @endphp
            @endforeach
        </x-svg.group>
    @endif
</x-svg.svg>
