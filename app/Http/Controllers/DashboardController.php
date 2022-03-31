<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Graphs\_Graph;
use App\Models\Sheet;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use PHPUnit\Exception;


class DashboardController extends Controller
{


    public function file(Request $request)
    {
        return view('file');;
    }

    public function settings(Request $request)
    {
        $data = $this->getData($request);
        if(!isset($data->url)){
            return redirect(route('file'));
        }
        Session::put('data',$data);
        $sheet = new Sheet(
            $data->url,
            $data->rowTitle-1,
            $data->columnDescription??null,
            $data->columnDuration??null
        );
        return view('settings',['sheet'=>$sheet ?? null]);
    }


    public function dashboard(Request $request,$slug='')
    {
        $data = $this->getData($request);
        if(!isset($request->graph)) {
            $data->graphs[0]->column1 = $data->graphs[0]->column1 ?? $data->column1;
            $data->graphs[0]->uuid = $data->graphs[0]->uuid ?? Str::uuid();
            $data->graphs[0]->type = $data->graphs[0]->type ?? 'timeline';
            $data->graphs[0]->start = $data->graphs[0]->start ?? null;
            $data->graphs[0]->end = $data->graphs[0]->end ?? null;
        }else{
            foreach($data->graphs as $graph) {
                if($graph->uuid==$request->graph) {
                    foreach ($request->all() as $key => $value) {
                        if($key=='order') {
                            if ($request->order > $graph->order) {
                                $value += 0.5; //on augmente de 0.5 pour éviter les égalites
                            }
                            if ($request->order < $graph->order) {
                                $value -= 0.5; //on augmente de 0.5 pour éviter les égalites
                            }
                        }
                        $graph->$key = $value;
                    }
                }
            }
        }

        $data->reorder();
        Session::put('data',$data);

        return redirect(route('fromData',['data'=>base64_encode(json_encode($data))]));
        //TODO gérer l'activité de début et de fin pour tous les graphes
        //TODO demander l'adresse mail et envoyer par mail le lien vers le dashboard
    }

    public function reset()
    {
        Session::remove('data');
        return redirect(route('file'));
    }

    public function fromData(Request $request,$data)
    {
        $dataObject = new Data(json_decode(base64_decode($data),false));

        Session::put('data',$dataObject);
        unset($data);

        if(!isset($dataObject->url)){
            return redirect(route('file'));
        }
        if(is_object($dataObject->graphs)){
            $dataObject->graphs=get_object_vars($dataObject->graphs);
        }
        if(count($dataObject->graphs)==0){
            $graph = new \stdClass();
            $graph->type='timeline';
            $graph->uuid=Str::uuid();
            $graph->rowTitle=$dataObject->rowTitle;
            $graph->columnDescription=$dataObject->columnDescription;
            $graph->columnDuration=$dataObject->columnDuration;
            $graph->column1=$dataObject->column1??null;
            $graph->column2=$dataObject->column2??null;
            $graph->column3=$dataObject->column3??null;
            $graph->start=$dataObject->start??null;
            $graph->end=$dataObject->end??null;
            $dataObject->graphs[]=$graph;
        }

        $sheet = new Sheet(
            $dataObject->url,
            $dataObject->rowTitle-1,
            $dataObject->columnDescription??null,
            $dataObject->columnDuration??null,
            $dataObject->start??null,
            $dataObject->end??null
        );

        return view('dashboard',[
            'data'=>$dataObject,
            'next'=>$dataRequest['next']??'file',
            'sheet'=>$sheet ?? null
        ]);

    }

    public function fromLink($url,$rowTitle,$columnDuration,$columnDescription,$column1,$column2=null,$column3=null,$start=null,$end=null)
    {
        $column2 = $column2=='-'?null:$column2;
        $column3 = $column3=='-'?null:$column3;
        $start = $start=='-'?null:$start;
        $end = $end=='-'?null:$end;

        $data=[];
        $data['url']=urldecode($url);
        $data['rowTitle']=$rowTitle;
        $data['columnDuration']=$columnDuration;
        $data['columnDescription']=$columnDescription;
        $data['column1']=$column1;
        $data['column2']=$column2;
        $data['column3']=$column3;
        $data['start']=$start;
        $data['end']=$end;
        Session::put('data',$data);

        return redirect(route('fromData',['data'=>base64_encode(json_encode($data))]));


    }

    public function changeLanguage($language)
    {
        Session::put('language',$language);
        app()->setLocale($language);
        return back();
    }

    private function getData(Request $request)
    {
        $data = new Data(Session::get('data') ?? []);
        $dataRequest = $request->toArray();
        if(isset($dataRequest['uuid'])){
            foreach ($data->graphs as $graph) {
                if($graph->uuid==$dataRequest['uuid']){
                    foreach($dataRequest as $key=>$value){
                        $graph->$key=$value;
                    }
                }
            }
        }else {
            $data = $data->merge($dataRequest);
        }

        Session::put('data',$data);
        return $data;
    }

    public function addGraph(Request $request)
    {
        $data = $this->getData($request );
        $type = $request->type ?? 'histogramme';
        $data->graphs[]=_Graph::create($type);;

        $data->reorder();
        Session::put('data',$data);

        return redirect(route('fromData',['data'=>base64_encode(json_encode($data))]));
    }

    public function removeGraph(Request $request,$uuid)
    {
        $data = $this->getData($request );

        foreach ($data->graphs as $i=>$graph) {
            if(isset($graph->uuid) and $graph->uuid==$uuid){
                unset($data->graphs[$i]);
            }
        }

        $data->reorder();
        Session::put('data',$data);
        return redirect(route('fromData',['data'=>base64_encode(json_encode($data))]));
    }
}
