<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AccountCreated;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //Mail::to("lucassouza0807@gmail.com")->send(new AccountCreated());
}
