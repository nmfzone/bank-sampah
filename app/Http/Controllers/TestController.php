<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Jobs\SendVerificationEmail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function coba()
    {
        echo url('auth/emails/verify');
        dd();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendMails($id)
    {
        $code = str_random(30);
        $link = url("register/verify/" . $code);
        $user = User::findOrFail($id);
        $this->dispatch(new SendVerificationEmail($user, $link));
    }
}
