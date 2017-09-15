<?php

namespace App\Http\Middleware;

use Closure;
use Lavary\Menu\Menu;
use App\Eloquent\Admin\MenuItem;
use Illuminate\Support\Facades\Auth;

class CollectUserMenu
{
    /**
     * @var Menu
     */
    protected $navBar;

    /**
     * CollectUserMenu constructor.
     *
     * @param Menu $navBar
     */
    public function __construct(Menu $navBar)
    {
        $this->navBar = $navBar;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            $this->guestNavBar();
        } else {
            $this->setNavbarLeft();
            $this->setNavbarRight();
        }

        return $next($request);
    }

    /**
     * 
     */
    public function setNavbarLeft()
    {
        $this->navBar->make('MyNavBar', function ($menu) {
            MenuItem::where('menu_id', 1)->each(function ($item, $key) use ($menu) {
                if ($item->parent_id === null) {
                    $parent = $menu;
                } else {
                    $parent = $menu->find($item->parent_id);
                }

                switch ($item->type) {
                    case 'DEF':
                        $parent->add($item->name, $item->link)
                            ->data('order', $item->sequence)
                            ->id($item->id);
                        break;
                    case 'DIV':
                        $parent->divide()->data('order', $item->sequence);
                        break;
                }
            });
        })->sortBy('order');
    }

    /**
     *
     */
    public function setNavbarRight()
    {
        $this->navBar->make('NavBarRight', function ($menu) {
            $logout = '<a href="'.route('logout').'" onclick="event.preventDefault();document.getElementById(\'logout-form\').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="'.route('logout').'" method="POST" style="display: block;">
                                   '.csrf_field().'
                                </form>';

            $menu->add('<i class="glyphicon glyphicon-star"></i>', 'favourite')->nickname('star');

            $menu->add('<i class="glyphicon glyphicon-cog"></i>', 'settings')->nickname('cog');

            $menu->cog->raw('Administrator', ['class' => 'dropdown-header']);
            $menu->cog->add('Roles', 'role');
            $menu->cog->add('Permissions', 'permission');
            $menu->cog->add('Teams', 'team');
            $menu->cog->add('Team Roles', 'teamRole');
            $menu->cog->divide();
            $menu->cog->add('Users', 'user');
            $menu->cog->divide();
            $menu->cog->raw('Issue', ['class' => 'dropdown-header']);
            $menu->cog->add('Issues', ['route' => 'issueType']);
            $menu->cog->divide();
            $menu->cog->add('General Settings', 'setting');
            $menu->add(Auth::user()->name)->nickname('user');
            $menu->user->add('Profile', 'profile');
            $menu->user->raw($logout);
        });
    }

    /**
     *
     */
    protected function guestNavBar()
    {
        $this->navBar->make('NavBarRight', function ($navBar) {
            $navBar->add('Login', 'login');
            $navBar->add('Register', 'register');
        });
    }
}
