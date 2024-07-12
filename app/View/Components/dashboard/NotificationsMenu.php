<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class NotificationsMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public $notifications;
    public $newCount;
    public function __construct($count=10)
    {
        $user=Auth::user();
        $this->notifications=$user->notifications()->take($count)->get();
        $this->newCount=$user->unreadNotifications()->count();//select count 
        // $this->newCount=$user->unreadNotifications->count();//select *
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.notifications-menu');
    }
}
