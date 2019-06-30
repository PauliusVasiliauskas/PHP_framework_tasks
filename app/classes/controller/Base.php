<?php

namespace App\Controller;

class Base extends \Core\Page\Controller {

    public function __construct() {
        parent::__construct();

        $navigation = new \App\View\Navigation(['header' =>
            [
                'link' => 'home',
                'title' => 'Home'
            ],
            [
                'link' => 'login',
                'title' => 'Login'
            ],
            [
                'link' => 'register',
                'title' => 'Register'
            ],
            [
                'link' => 'logout',
                'title' => 'Logout'
            ]
        ]);
        $this->page['header'] = $navigation->render(ROOT_DIR . '/app/views/navigation.tpl.php');
    }

}
