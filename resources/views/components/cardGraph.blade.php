<div class="card-body">
    <a class="btn btn-primary btn-sm" onclick="$(this).next().toggle()">
        {{__('Settings')}}
    </a>
    <div class="collapse m-2">
        <form action="{{route('dashboard')}}" method="POST">
            @csrf
            <div class="card card-body">
        <div class="row">
            <div class="col-10">
                <x-form.select-row class="cols" value="{{$data['column1'] ??''}}" name="column1" label="Select the column used to generate the axis of the timeline" :options="$sheet->cols"></x-form.select-row>
            </div>
            <div class="col-2">
                <input type="submit" class="btn btn-primary float-right" value="{{__('Actualiser')}}"></input>
            </div>

        </div>
        <div class="row">
            <div class="col-5">
                <div class="form-group">
                    <x-form.select-row class="cols" :empty="true" value="{{$data['column2'] ??''}}" name="column2" label="Sélectionner la seconde colonne (facultatif) :" :options="$sheet->cols"></x-form.select-row>
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <x-form.select-row class="cols" :empty="true" value="{{$data['column3'] ??''}}" name="column3" label="Sélectionner la troisième colonne (facultatif) :" :options="$sheet->cols"></x-form.select-row>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <div class="form-group">
                    <x-form.select-row :empty="true" class="refs" name="start" value="{{$data['start'] ?? ''}}" label="Sélectionner la première activité à afficher :" :options="$sheet->refs"></x-form.select-row>
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <x-form.select-row :empty="true" class="refs" name="end" value="{{$data['end'] ?? ''}}" label="Sélectionner la dernière activité à afficher :" :options="$sheet->refs"></x-form.select-row>
                </div>
            </div>

        </div>

    </div>
        </form>
    </div>

    <div id="timeline" class="border bg-light p-2 m-2">
        <x-graph.timeline :sheet="$sheet" :data="$data">

        </x-graph.timeline>
    </div>
    <a href="{{route('fromLink',['url'=>urlencode(urlencode($data['url'])),'rowTitle'=>$data['rowTitle'],
                                    'columnDescription'=>$data['columnDescription'],'columnDuration'=>$data['columnDuration'],
                                    'column1'=>$data['column1'],'column2'=>$data['column2'] ?? '-','column3'=>$data['column3'] ?? '-',
                                    'start'=>$data['start']?? '-','end'=>$data['end'] ?? '-'
                                ])}}">{{__('Link')}}</a>
</div>
