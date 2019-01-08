<div class="row adminHeader px-1">

 <div class="col-8">
         <notification-icon-and-window
         :no-of-unread-notifications="{{count($user->unreadNotifications)}}"
         :total-no-of-notifications="{{count($user->notifications)}}"
         >
         {{-- procitane norifikacije --}}
                    <div class="unreadNotifications" slot='unreadNotifications'>
                      <ul>
                     @foreach ($user->unreadNotifications as $key=>$notification)
                         @if($key<=9)
                         <li>@include('admin.notifications.inWindow.'.class_basename($notification->type))</li>
                         @endif
                     @endforeach
                      </ul>
                      @if(count($user->unreadNotifications) > 10)
                        <div class="seeMoreNotifications"><a href="{{route('unseenNotifications')}}"><p>
                          ...i još {{count($user->unreadNotifications) - 10}} nepregledanih notifikacija
                        </p></a></div>
                      @endif
                   </div>

           {{-- neprocitane notifikacije --}}
                 <div class="readNotifications" slot='readNotifications'>
                   <ul>
                     @foreach ($user->notifications()->whereNotNull('read_at')->get() as $key=>$notification)
                       @if($key<=9)

                       {{-- @if(\App\Suggestion::where('id', $notification->data['id'])->first()) --}}
                         <li>@include('admin.notifications.inWindow.'.class_basename($notification->type))</li>
                       {{-- @endif --}}
                      @endif
                     @endforeach
                   </ul>
                   <div class="seeMoreNotifications"><a href="{{route('notifications')}}"><p>
                     pogledajte sve notifikacije
                   </p></a></div>
                 </div>

         </notification-icon-and-window>
      </div>

      <div class="col-4 d-flex justify-content-end">
        <h3 class=""><a class="c1Link" href="{{route('profile')}}"><i class="fas fa-user"></i> Ciao, {{$user->name}} &nbsp; &nbsp;</a></h3>
      </div>

  @include('includes.adminNav')
</div>
