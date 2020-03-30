<?php
namespace App\Http\Creators;

use Illuminate\View\View;

use App\Models\Balance;

use Config;
use Route;
use Auth;


class NotificationCreator
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
    */
    public function create(View $view)
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $message = "";

        view()->share('balance_notification', $message);

    }
}