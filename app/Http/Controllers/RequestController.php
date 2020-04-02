<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateRequest;
use App\Request as RequestModel;
use Illuminate\Support\Facades\Auth;


class RequestController extends Controller
{
    public function newRequest()
    {
        return view('newRequest');
    }

    public function  submit(CreateRequest $req){
        $today = date("Y-m-d");  
        $reqbool = RequestModel::where('user_id', Auth::user()->id)->whereDate('created_at', $today )->first();
        if (isset($reqbool)){

           return redirect()->route('homeUser')->with('warning', 'Вы сегодня уже создавали заявку');
        }
        session(['warning' => '']);
        $request  = new RequestModel();
        $request->status = 0;
        $request->user_id = Auth::user()->id;
        $request->title = $req->input('title');
        $request->message_user = $req->input('message');
        $file = $req->file('file');
        if (isset($file)){
            $path =  $file->store('uploads', 'public');
            if (isset($path)){
                $request->url_file = $path;
            }
        } else {
            $request->url_file = null;
        }
        $request->save();
        app('App\Http\Controllers\MailController')->send($request);
        return redirect()->route('homeUser')->with('success', "Заявка отправлена");
    }

    public function  updateSubmit($id, CreateRequest $req){
        $request  = RequestModel::find($id);
        $request->title = $req->input('title');
        $request->message_user = $req->input('message');
        $file = $req->file('file');
        if (isset($file)){
            $path =  $file->store('uploads', 'public');
            if (isset($path)){
                $request->url_file = $path;
            }
        } else {
            $request->url_file = null;
        }
        $request->save();
        return redirect()->route('homeUser')->with('success', "Заявка обновлена");
    }

    public function  updateSubmitManager($id, CreateRequest $req){
        $request  = RequestModel::find($id);
        $request->message_manager = $req->input('message');
        $request->save();
        return redirect()->route('homeManager')->with('success', "Добавлен ответ на заявку");
    }

    public function allDataUser(){
        $request = RequestModel::where('user_id', Auth::user()->id)->get();
        return view('allRequests', ['data' => $request]);
    }

    public function allData(){
        $request = RequestModel::all();
        return view('allRequests', ['data' => $request]);
    }


    public function updateRequest($id){
        $request = RequestModel::find($id);
        
        if(Auth::user()->is_manager == 1){
            return redirect()->route('request-update-manager', $id);
        }
        return view('updateRequest', ['data' => $request]);
    }

    public function updateRequestManager($id){
        $request = RequestModel::find($id);
        if($request->status == 0){
            $request->status = 1;
        }
        $request->save();
        return view('updateRequestManager', ['data' => $request]);
    }

    public function close($id){
        $request = RequestModel::find($id);
        if (
            isset($request)  && 
            (
                ($request->user_id == Auth::user()->id) ||
                ($request->is_manager == 1)
            )
            ){
                $request->status = 3;
                $request->save();
                app('App\Http\Controllers\MailController')->send($request);
                
            }
        if (Auth::user()->is_manager){
            return redirect()->route('request-data-manager');
        } 
        return redirect()->route('request-data');
    }

    public function  accept($id, CreateRequest $req){
        $request  = RequestModel::find($id);
        $request->status = 2;
        $request->save();
        return redirect()->route('request-data-manager')->with('success', "Заявка принята");
    }



       
}