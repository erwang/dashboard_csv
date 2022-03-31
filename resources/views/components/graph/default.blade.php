<div class="card-body col-{{ $graph->nbCols ?? '12' }}">
    <a class="btn btn-danger btn-sm float-right" href="{{route('removeGraph',['uuid'=>$graph->uuid])}}">
        <i class="fa fa-trash"></i>
    </a>
    <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#settings-{{$graph->uuid}}">
{{--        {{__('Graph settings')}}--}}
        <i class="fa fa-cog"></i>
    </a>

    <form action="{{route('dashboard')}}" method="POST">
    <x-modal id="settings-{{$graph->uuid}}" title="{{__('Graph settings')}}" labelledBy="">
            @csrf
            <input type="hidden" name="graph" value="{{$graph->uuid}}">
            <div class="card card-body">
                {{$formSettings}}
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <x-form.select-row :empty="true" class="refs" name="start" value="{{$graph->start ?? ''}}"
                                               label="Sélectionner la première activité à afficher :"
                                               :options="$sheet->refs"></x-form.select-row>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <x-form.select-row :empty="true" class="refs" name="end" value="{{$graph->end ?? ''}}"
                                               label="Sélectionner la dernière activité à afficher :"
                                               :options="$sheet->refs"></x-form.select-row>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="nbCols" class="form-label">{{__('Largeur du graphique :')}}</label>
                                <x-form.select name="nbCols">
                                    <option value="12" {{($graph->nbCols ?? 12)==12 ?'selected':''}}>100%</option>
                                    <option value="9" {{($graph->nbCols ?? 12)==9 ?'selected':''}}>75%</option>
                                    <option value="8" {{($graph->nbCols ?? 12)==8 ?'selected':''}}>66%</option>
                                    <option value="6" {{($graph->nbCols ?? 12)==6 ?'selected':''}}>50%</option>
                                    <option value="4" {{($graph->nbCols ?? 12)==4 ?'selected':''}}>33%</option>
                                    <option value="3" {{($graph->nbCols ?? 12)==3 ?'selected':''}}>25%</option>
                                    <option value="2" {{($graph->nbCols ?? 12)==2 ?'selected':''}}>16%</option>
                                </x-form.select>
                            </div>

                        </div>
                    </div>
                    <div class="col-3">
                        <x-form.input name="order" label="{{__('Order on page')}}" type="text" value="{{$graph->order ?? '-'}}" />
                    </div>

                </div>
            </div>
        <x-slot name="footer">
            <input type="submit" class="btn btn-primary float-right" value="{{__('Actualiser')}}"></input>
        </x-slot>
    </x-modal>
    </form>

    {{$slot}}
    @if(null!=$graph->start or null!=$graph->end)
    {{__('Range:')}} {{$graph->start}} <i class="fa fa-caret-right"></i> {{$graph->end}}
    @endif

</div>
