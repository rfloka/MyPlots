<?php

namespace MyPlots\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use MyPlots\Mail\SendKey;

class MailController extends Controller
{
    public function send(request $request)
    {
        $from = $_POST['from'];
        $too = $_POST['to'];
        $subject = $_POST['subject'];
        $text = $_POST['message'];
        $myText = (string)$text;
        $visto = false;
        $time = Carbon::now();
        DB::insert('INSERT INTO mails (assunto,texto,de,para,data,visto) VALUES (?,?,?,?,?,?)', [$subject, $myText, $from, $too, $time, $visto]);
        \Mail::to($too)->send(new \MyPlots\Mail\RecebeuMensagem);
        return back();
    }

    public function sendkey(request $request, \Illuminate\Mail\Mailer $mailer)
    {
        $email = $_POST["email"];
        $token = md5($email);
        $query = DB::table('ApiUsers')->where('email', '=', $email)->pluck('email');
        if ($query != "[]") {
            return back()->with('erro', 'Email já tem key');
        }
        DB::insert('INSERT INTO ApiUsers (email,token) VALUES (?,?)', [$email, $token]);
        $mailer->to($email)->send(new SendKey($email, $token));
        return back()->with('alert', 'Key enviada:Verifique o seu Email');
    }


}
