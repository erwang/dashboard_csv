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
        if(isset($data['url'])) {
            $sheet = new Sheet(
                $data['url'],
                $data['rowTitle']-1,
                $data['columnDescription']??null,
                $data['columnDuration']??null);
        }
        return view('settings',['sheet'=>$sheet ?? null]);
    }

    public function dashboard(Request $request,$slug='')
    {
        $data = $this->getData($request);
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

    public function reset()
    {
        Session::remove('data');
        return redirect(route('file'));
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
