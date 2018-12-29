<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index($type = null){
      if(!$type){
        $notifications = \Auth::user()->notifications()->paginate(15);
      }else{
        $notifications = $type == 'seen'? \Auth::user()->unreadNotifications()->paginate(15) : \Auth::user()->notifications()->whereNotNull('read_at')->paginate(15);
      }
      $noTotal = count(\Auth::user()->notifications);
      $noOfUnseen = count(\Auth::user()->unreadNotifications);
      $noOfSeen = count(\Auth::user()->readNotifications);


      return view('admin.listedNotifications', compact('notifications', 'noTotal', 'noOfSeen', 'noOfUnseen'));
    }

    // public function edit(\Illuminate\Notifications\Notification $notification){
    public function edit($notification){
      $notif = \Auth::user()->notifications()->find($notification);
      !$notif->read_at? $notif->markAsRead() : $notif->markAsUnread();
      return redirect()->back();
    }
}
