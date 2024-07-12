   <li class="dropdown notifications-menu">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    @if($newCount)
                    <span class="label label-warning">{{ $newCount }}</span>
                    @endif
                 </a>

                 <ul class="dropdown-menu">
                     
                    <li class="header">You have {{ $newCount  }} notifications</li>
                    <li>
                        {{--<!-- inner menu: contains the actual data -->--}}
                        <ul class="menu">
                            <li>
                            @foreach($notifications as $notification)
                                {{-- middleware MarkNotificationAsRead --}}
                                <a href="{{$notification->data['url'] }}?notification_id={{ $notification->id }}" style="{{ $notification->read_at ? '' : 'color: red !important;' }}">

                                    <i class="{{ $notification->data['icon'] }} text-aqua"></i> {{ $notification->data['body'] }}

                                    <span class="float-right text-muted text-sm">{{ $notification->created_at->longAbsoluteDiffForHumans() }}</span>
                                    
                                </a>
                            @endforeach
                    
                        </ul>
                    </li>
                    <li class="footer">
                        <a href="#">See All Notifications</a>
                    </li>
                 </ul>
                                
    </li>







    
    <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if ($newCount)
        <span class="badge badge-warning navbar-badge">{{ $newCount }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">{{ $newCount }} Notifications</span>
        <div class="dropdown-divider"></div>
        @foreach($notifications as $notification)
        <a href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}" class="dropdown-item text-wrap @if ($notification->unread()) text-bold @endif">
            <i class="{{ $notification->data['icon'] }}??fas fa-file mr-2"></i> {{ $notification->data['body'] }}
            <span class="float-right text-muted text-sm">{{ $notification->created_at->longAbsoluteDiffForHumans() }}</span>
        </a>
        <div class="dropdown-divider"></div>
        @endforeach
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>
