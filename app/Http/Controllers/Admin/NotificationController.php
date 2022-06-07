<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        foreach ($user->notifications as $not)
        {
            echo $not->MarkAsRead();
            // echo  $not->read_at->diffForHumans();
        }
    }
}
