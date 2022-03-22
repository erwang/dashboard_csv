<div class="card-body col-{{ $graph->nbCols ?? '12' }}">
    <a class="btn btn-danger btn-sm float-right" href="{{route('removeGraph',['uuid'=>$graph->uuid])}}">
        <i class="fa fa-trash"></i>
    </a>
    <a class="btn btn-primary btn-sm" onclick="$(this).next().toggle()">
        {{__('Settings')}}
        <i class="fa fa-caret-down"></i>
    </a>
    <div class="collapse m-2">
        <form action="{{route('dashboard')}}" method="POST">
            @csrf
            <input type="hidden" name="graph" value="{{$graph->uuid}}">
            <div class="card card-body">
                {{$formSettings}}
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <x-form.select-row :empty="true" class="refs" name="start" value="{{$graph->start ?? ''}}"
                                               label="Sélectionner la première activité à afficher :"
                                               :options="$sheet->refs"></x-form.select-row>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <x-form.select-row :empty="true" class="refs" name="end" value="{{$graph->end ?? ''}}"
                                               label="Sélectionner la dernière activité à afficher :"
                                               :options="$sheet->refs"></x-form.select-row>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>

    {{$slot}}

</div>
