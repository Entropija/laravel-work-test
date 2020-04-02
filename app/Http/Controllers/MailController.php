<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Routing\UrlGenerator;
use Mail;

class MailController extends Controller
{
    public function send($mess){
        $fileURLFull = null;
        if (isset($mess->url_file)){
            $file = $mess->url_file;
            $fileURLFull = $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $file;
        }

        Mail::send('mail', compact('mess'), function($message) use ($fileURLFull ){
            $message->to('av.fedorova@mail.ru', 'ManagerSystem')->subject('Новая заявка');
            $message->from('portal@request.com', 'Система управления заявками');
            if(isset($fileURLFull)){
                $message->attach($fileURLFull);   
            }
        });
    }
}
