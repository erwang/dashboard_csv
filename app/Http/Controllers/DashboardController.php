<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Sheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class DashboardController extends Controller
{


    public function file(Request $request)
    {
        return view('file');;
    }

    public function settings(Request $request)
    {
        $data = $this->getData($request);
        if(!isset($data['url'])){
            return redirect(route('file'));
        }
        $sheet = new Sheet(
            $data['url'],
            $data['rowTitle']-1,
            $data['columnDescription']??null,
            $data['columnDuration']??null);
        return view('settings',['sheet'=>$sheet ?? null]);
    }

    public function dashboard(Request $request,$slug='')
    {
        $data = $this->getData($request);

        return redirect(route('fromLink',['url'=>urlencode(urlencode($data['url'])),'rowTitle'=>$data['rowTitle'],
            'columnDescription'=>$data['columnDescription'],'columnDuration'=>$data['columnDuration'],
            'column1'=>$data['column1'],'column2'=>$data['column2'] ?? '-','column3'=>$data['column3'] ?? '-',
            'start'=>$data['start']?? '-','end'=>$data['end'] ?? '-'
        ]));
    }

    public function reset()
    {
        Session::remove('data');
        return redirect(route('file'));
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

        if(!isset($data['url'])){
            return redirect(route('file'));
        }
        $sheet = new Sheet(
            $data['url'],
            $data['rowTitle']-1,
            $data['columnDescription']??null,
            $data['columnDuration']??null,
            $data['start']??null,
            $data['end']??null
        );

        return view('dashboard',[
            'data'=>$data,
            'next'=>$dataRequest['next']??'file',
            'sheet'=>$sheet ?? null
        ]);


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
        $data = $data->merge($dataRequest)->intersectByKeys([
            #file
            'url'=>'','rowTitle'=>'',
            #settings
            'columnDescription'=>'','columnDuration'=>'','column1'=>'','start'=>null,'end'=>null,
            #dashboard
            'column2'=>null,'column3'=>null
        ]);
        Session::put('data',$data);
        return $data;
    }
}
