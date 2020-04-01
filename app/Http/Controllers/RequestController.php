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
       // dd(Auth::user()->id);
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
        return redirect()->route('home')->with('success', "Сообщение отправлено");
    }
}