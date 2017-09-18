<?php

use App\Eloquent\Admin\Menu;
use App\Eloquent\Admin\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    private $_menus = [
        [
            'menu_id'   => 1,
            'parent_id' => null,
            'name'      => 'Dashboard',
            'link'      => '',
            'sequence'  => 10,
            'enabled'   => 'Y',
            'type'      => 'DEF',

        ],
        [
            'menu_id'   => 1,
            'parent_id' => 1,
            'name'      => 'My Dashboard',
            'link'      => '',
            'sequence'  => 20,
            'enabled'   => 'Y',
            'type'      => 'DEF',

        ],
        [
            'menu_id'   => 1,
            'parent_id' => 1,
            'name'      => 'div',
            'link'      => '',
            'type'      => 'DIV',
            'sequence'  => 25,
            'enabled'   => 'Y',
        ],
        [
            'menu_id'   => 1,
            'parent_id' => 1,
            'name'      => 'Manage Dashboard',
            'link'      => 'home',
            'sequence'  => 30,
            'enabled'   => 'Y',
            'type'      => 'DEF',

        ],
        [
            'menu_id'   => 1,
            'parent_id' => null,
            'name'      => 'Projects',
            'link'      => '',
            'sequence'  => 20,
            'enabled'   => 'Y',
            'type'      => 'DEF',

        ],
        [
            'menu_id'   => 1,
            'parent_id' => 5,
            'name'      => 'View All Projects',
            'link'      => 'projects',
            'sequence'  => 10,
            'enabled'   => 'Y',
            'type'      => 'DEF',
        ],
        [
            'menu_id'   => 1,
            'parent_id' => null,
            'name'      => 'Issues',
            'link'      => 'issues',
            'sequence'  => 30,
            'enabled'   => 'Y',
            'type'      => 'DEF',

        ],
        [
            'menu_id'   => 1,
            'parent_id' => null,
            'name'      => 'Boards',
            'link'      => 'boards',
            'sequence'  => 40,
            'enabled'   => 'Y',
            'type'      => 'DEF',

        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = new Menu();
        $menu->name = 'MyNavBar';
        $menu->description = 'NavbarLeft';
        $menu->save();

        $menu = new Menu();
        $menu->name = 'NavbarRight';
        $menu->save();

        $menu = new Menu();
        $menu->name = 'guestNavBar';
        $menu->save();

        foreach ($this->_menus as $menu) {
            $menuitem = new MenuItem();

            $menuitem->menu_id = $menu['menu_id'];
            $menuitem->parent_id = $menu['parent_id'];
            $menuitem->name = $menu['name'];
            $menuitem->link = $menu['link'];
            $menuitem->type = $menu['type'];
            $menuitem->sequence = $menu['sequence'];

            $menuitem->save();
        }
    }
}
