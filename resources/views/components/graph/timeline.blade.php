<x-graph.default :graph="$graph" :sheet="$sheet">
    <x-slot name="formSettings">
                <div class="row">
                    <div class="col-10">
                        <x-form.select-row class="cols" value="{{$graph->column1 ??''}}" name="column1"
                                           label="Select the column used to generate the axis of the timeline"
                                           :options="$sheet->cols"></x-form.select-row>
                    </div>
                    <div class="col-2">
                        <input type="submit" class="btn btn-primary float-right" value="{{__('Actualiser')}}"></input>
                    </div>

                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <x-form.select-row class="cols" :empty="true" value="{{$graph->column2 ??''}}" name="column2"
                                               label="Sélectionner la seconde colonne (facultatif) :"
                                               :options="$sheet->cols"></x-form.select-row>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <x-form.select-row class="cols" :empty="true" value="{{$graph->column3 ??''}}" name="column3"
                                               label="Sélectionner la troisième colonne (facultatif) :"
                                               :options="$sheet->cols"></x-form.select-row>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <x-form.input value="{{$graph->timeInterval ??''}}" name="timeInterval"
                                               label="Ajouter un intervalle de temps (laisser vide pour annuler) :"></x-form.input>
                        </div>
                    </div>
                </div>
    </x-slot>
        <div id="timeline" class="border bg-light p-2 mt-2">

            @if(null!==$graph->column1)
                <h1>{{ $sheet->cols[$graph->column1] }}</h1>
                <x-svg.svg width="{{$width}}" height="{{$height}}" title="{{ $sheet->cols[$graph->column1]  }}">
                    @foreach($timeIntervalLines as $timeLine)
                        <x-svg.line x1="{{$timeLine['x']}}" y1="{{0}}" x2="{{$timeLine['x']}}" y2="{{$height}}"
                                    style="stroke:rgb(100,0,0);stroke-width:0.5;stroke-dasharray:10,10;stroke-opacity:.5"></x-svg.line>
                    @endforeach

                @foreach($lines as $value=>$line)
                        <x-svg.group>
                            <x-svg.text x="0" y="{{ $line->y+$lineHeight/2 }}">
                                @if($value=='')
                                    {{__('empty')}}
                                @else
                                    {{$value}}
                                @endif
                            </x-svg.text>
                            <x-svg.line x1="{{$startLine}}" y1="{{$line->y+15}}" x2="{{$width-$margin}}" y2="{{$line->y+15}}"
                                        style="stroke:rgb(200,200,200);stroke-width:2"></x-svg.line>
                            @foreach($line->areas as $area)
                                <x-svg.rectangle x="{{max($area['x'],$margin)+$startLine}}" y="{{$area['y']}}"
                                                 width="{{$area['width']-$margin}}" height="{{ $lineHeight/1.5 }}"
                                                 style="fill:{{$area['color']}}"
                                                 tooltip="{!! $area['description'] !!}"
                                >

                                </x-svg.rectangle>
                                <x-svg.text x="{{max($area['x'],$margin)+$startLine+$margin}}" y="{{$line->y+$lineHeight/2-1}}"
                                            style="font-size: 0.6em">
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
                                {{$sheet->cols[$graph->column2]}}
                            </x-svg.text>
                            @php $y+=$lineHeight+$margin; @endphp
                            @foreach($distinctValuesColumn2 as $value=>$color)
                                <x-svg.rectangle x="{{$x0}}" y="{{$y-$lineHeight}}" width="{{$lineHeight-$margin}}"
                                                 height="{{$lineHeight-$margin}}" style="fill:{{$color}}"></x-svg.rectangle>
                                <x-svg.text x="{{$x0 + $lineHeight+$margin}}"
                                            y="{{$y-$lineHeight/4}}">{{$value=='' ? __('empty') : $value}}</x-svg.text>
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
                                {{$sheet->cols[$graph->column3]}}
                            </x-svg.text>
                            @php $y+=$lineHeight+$margin; @endphp
                            @foreach($distinctValuesColumn3 as $value=>$color)
                                <x-svg.rectangle x="{{$x0}}" y="{{$y-$lineHeight}}" width="{{$lineHeight-$margin}}"
                                                 height="{{$lineHeight-$margin}}" style="fill:{{$color}}"></x-svg.rectangle>
                                <x-svg.text x="{{$x0+ $lineHeight+$margin}}"
                                            y="{{$y-$lineHeight/4}}">{{$value=='' ? __('empty') : $value}}</x-svg.text>
                                @php $y+=$lineHeight; @endphp
                            @endforeach
                        </x-svg.group>
                    @endif
                </x-svg.svg>
            @endif
        </div>

</x-graph.default>

