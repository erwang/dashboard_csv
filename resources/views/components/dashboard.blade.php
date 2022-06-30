<x-card id="dashboard" class="menu-panel">
    <x-slot name="title">
        <span class="font-weight-bold" style="padding-right: 1em">
            {{__('Dashboard')}}
        </span>
{{--        <a class="btn btn-outline-secondary btn-sm " href="">--}}
{{--            <i class="fa fa-envelope"></i>--}}
{{--        </a>--}}
        @if(!$readonly)
        <div type="button" class="btn" data-toggle="popover" title="{{__('Disclaimer')}}" data-content="{{__('Warning: anyone with the link may be able to access the contents of the spreadsheet used.')}}">
            <a href="{{ URL::current() }}">{{__('Sharing link')}}</a>
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
        </div>

{{--        <a href="#" data-toggle="modal" data-target="#sharingModal">--}}
{{--            <i class="fa fa-share-alt-square"></i>--}}
{{--        </a>--}}
        @endif


{{--        <a class="btn btn-outline-secondary btn-sm">--}}
{{--            <i class="fa fa-link"></i>--}}
{{--        </a>--}}

{{--        <a class="btn btn-outline-secondary btn-sm " href="https://twitter.com/intent/tweet?text={{urlencode(__('Mon dernier dashboard : ')).URL::current()}}" target="_blank">--}}
{{--            <i class="fab fa-twitter"></i>--}}
{{--        </a>--}}
    </x-slot>
    @if(!$readonly)
    <x-slot name="tools">
        <span class="dropdown">
            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownAddGraph" data-toggle="dropdown" aria-expanded="false">
                {{ __('Add a chart') }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownAddGraph">
                <li><a class="dropdown-item" href="{{route('addGraph','timeline')}}">{{__('Timeline')}}</a></li>
                <li><a class="dropdown-item" href="{{route('addGraph','histogramme')}}">{{__('Lignes')}}</a></li>
                <li><a class="dropdown-item" href="{{route('addGraph','doughnut')}}">{{__('Donut')}}</a></li>
                <li><a class="dropdown-item" href="{{route('addGraph','radar')}}">{{__('Radar')}}</a></li>
            </ul>
        </span>
    </x-slot>
    @endif
    <div class="row">

    @if($sheet->totalDuration==0)
            <div class="alert alert-danger" role="alert">
                La colonne "Durée" n'est pas lisible, avez-vous bien utilisé des valeurs de type "nombre" ?
            </div>
    @else
        @foreach($data->graphs as $graph)
            @if(isset($graph->type))
            <x-dynamic-component :component="'graph.'.$graph->type ?? 'timeline'" :sheet="$sheet" :graph="$graph" :readonly="$readonly">
            </x-dynamic-component>
            @else
                @dd($graph)
            @endif
        @endforeach
        </div>
        @if(!$readonly)
        <x-modal id="sharingModal" title="{{__('Sharing')}}">
            <div class="row">
                <div class="col-12 text-muted">
                    Attention, la génération de liens nécessite de stocker sur notre serveur l'URL de votre tableur ainsi que l'ensemble des données de configuration de votre tableau de bord.
                    Les données présentes dans votre tableur ne seront pas stockées sur le serveur.
                    Pour davantage de sécurtié, tous les fichiers sont chiffrés avant d'être enregistrés.
                </div>
                <hr>
                <div class="col-12">
                    <li>
                    @if(isset($data->sharingLink))
                        Lien de collaboration : <a href="{{route('fromUpdateLink',['link'=>$data->sharingLink])}}">{{route('fromUpdateLink',['link'=>$data->sharingLink])}}</a>
                    @else
                        <a href="{{route('createUpdateLink',['data'=>base64_encode(json_encode($data))])}}">Générer un lien de collaboration</a>
                    @endif
                    <br>
                    Le lien de collaboration permet de collaborer à plusiuers utilisateurs sur un même tableau de bord.<br>
                    </li>
                </div>

                <div class="col-12">
                    <li>
                    @if(isset($data->readonlyLink))
                        Lien de partage : <a href="{{route('fromReadonlyLink',['link'=>$data->readonlyLink])}}">{{route('fromReadonlyLink',['link'=>$data->readonlyLink])}}</a>
                    @else
                        <a href="{{route('createReadonlyLink',['data'=>base64_encode(json_encode($data))])}}">Générer un lien de partage</a>
                    @endif
                    Le lien de partage permet uniquement de consulter le tableau de bord, aucune modification ne peut être faite. Les données du tableur ne sont pas directement accessibles.<br>
                    </li>
                </div>
            </div>
            <x-slot name="footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('Close')}}</button>
            </x-slot>
        </x-modal>
        @endif
    @endif
{{--   TODO ajouter un export PDF --}}
</x-card>
