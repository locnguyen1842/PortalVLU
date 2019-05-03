<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Carbon\Carbon;
class NotificationController extends Controller
{
    public function read(){
        $unread_noti = Notification::where('read_at',null)->get();
        foreach($unread_noti as $item){
            $item->read_at = Carbon::now();
            $item->save();
        }
        return redirect()->route('admin.confirmation.index');
    }
}
