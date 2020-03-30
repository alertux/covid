<?php
namespace App\Http\Creators;

use Illuminate\View\View;

use Config;
use Route;
use Auth;

use App\Models\Roles_User;

class BreadcrumbsCreator
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

        $current_route = explode('.', Route::currentRouteName());
        $menu = config('menu.menu');
        $user = Auth::User();
        $user_role = $user->permission->role;

        $main_menu = $menu[$user_role];

        $breadcrumbs = array();
        if( isset($main_menu[$current_route[0] . '.index']) )
            $page_title = $main_menu[$current_route[0] . '.index']['title'];
        else
            foreach ($main_menu as $key => $menu) {
                if(isset($menu['children']))
                    foreach ($menu['children'] as $subkey => $submenu) {
                        if($subkey == $current_route[0] . '.index')
                            $page_title = $submenu['title'];
                    }
            }

        if( $current_route[0] != "dashboard") {
            $breadcrumbs[] = array(
                'title' => $page_title,
                'url' => route($current_route[0] . '.index')
            );
        }else
            $breadcrumbs[] = array(
                'title' => ' Dashboard',//. ucfirst($current_route[0])
                'url' => ''
            );

        if( count($current_route)>1 && $current_route[1] != 'index')
            $breadcrumbs[] = array(
                'title' => ucfirst($current_route[1]),
                'url' => route($current_route[0] . '.index')
            );



        view()->share('breadcrumbs', $breadcrumbs);
        view()->share('main_title', strip_tags($breadcrumbs[count($breadcrumbs) - 1]['title']));
    }
}