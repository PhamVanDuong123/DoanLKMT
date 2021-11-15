<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    function send_mail(){
        //send mail
        $from_name = "Công ty TNHH HD Computer";
        $to_email = "hunghuynh813@gmail.com";//send to this email
       
     
        $data = array("name"=>"Test thử gửi maillll","body"=>'Mail này được gửi từ 0306181234@caothang.edu.vn đến hunghuynh813@gmail.com'); //body of mail.blade.php
        
        Mail::send('mail.send_mail',$data,function($message) use ($from_name,$to_email){

            $message->to($to_email)->subject('Test thử gửi mail google');//send this mail with subject
            $message->from($to_email,$from_name);//send from this mail

        });
        // return redirect('/')->with('message','');
        //--send mail
    }
}
