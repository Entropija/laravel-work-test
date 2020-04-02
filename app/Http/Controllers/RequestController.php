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
        return redirect()->route('home')->with('success', "Заявка обновлена");
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
        $request = new RequestModel;
        return view('updateRequest', ['data' => $request->find($id)]);
    }

       
}