<div class="card-body col-{{ $graph->nbCols ?? '12' }}">
    <a class="btn btn-danger btn-sm float-right" href="{{route('removeGraph',['uuid'=>$graph->uuid])}}">
        <i class="fa fa-trash"></i>
    </a>
    <a class="btn btn-primary btn-sm" onclick="$(this).next().toggle()">
        {{__('Graph settings')}}
        <i class="fa fa-caret-down"></i>
    </a>
    <div class="collapse m-2">
        <form action="{{route('dashboard')}}" method="POST">
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
        </form>
    </div>

    {{$slot}}
    @if(null!=$graph->start or null!=$graph->end)
    {{__('Range:')}} {{$graph->start}} <i class="fa fa-caret-right"></i> {{$graph->end}}
    @endif

</div>
