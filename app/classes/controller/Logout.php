<?php

namespace App\Controller;

class Logout extends \App\Controller\Base {

    public function __construct() {
        parent::__construct();
        if (\App\App::$session->isLoggedIn()) {
            $form = new \App\Objects\Logout();
            $this->page ['title'] = 'Logout';
            switch ($form->process()) {
                case \App\Objects\Logout::STATUS_SUCCESS:
                    \App\App::$session->logout();
                    header("Location: /home");
                    die();

                    break;

                default :
                    $this->page['content'] = $form->render();
            }
        } else {
            header("Location: /login");
            die();
        }
    }

}
