<?php
namespace App\Http\Creators;

use Illuminate\View\View;

use Config;
use Route;
use Auth;

use App\Models\Roles_User;

class MenuCreator
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

        $escapes = array(
            'account::getRecords'
        );

        if (in_array(Route::currentRouteName(), $escapes)) 
            return;
        
        $current_route = Route::currentRouteName();

        $menu = config('menu.menu');
        $user = Auth::User();
        $user_role = $user->permission->role;

        $main_menu = $menu[$user_role];
        foreach ($main_menu as $key => $menu) {
            if(!isset($menu['children'])) {
                $main_menu[$key]['url'] = route($key);
                $main_menu[$key]['active'] = false;
                if ($key == $current_route || explode('.', $key)[0] == explode('.', $current_route)[0]) {
                    $main_menu[$key]['active'] = true;
                } else {
                    $main_menu[$key]['active'] = false;
                }
            }else {
                $main_menu[$key]['url'] = '';
                $main_menu[$key]['active'] = false;
                foreach ($menu['children'] as $subkey => $submenu) {
                    $main_menu[$key]['children'][$subkey]['url'] = route($subkey);
                    if ($subkey == $current_route || explode('.', $subkey)[0] == explode('.', $current_route)[0]) {
                        $main_menu[$key]['children'][$subkey]['active'] = true;
                        $main_menu[$key]['active'] = true;
                    } else {
                        $main_menu[$key]['children'][$subkey]['active'] = false;
                    }


                }

            }

        }
        //var_dump($main_menu);
        view()->share('main_menu', $main_menu);

        view()->share('user', $user);          
    }
}