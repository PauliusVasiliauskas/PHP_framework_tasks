<?php

namespace App\Controller;

class Login extends Base {

    public function __construct() {
        parent::__construct();
        $this->page ['title'] = 'Login';
        if (\App\App::$session->isLoggedIn()) {
            header("Location: /home");
            die();
        } else {
            $form = new \App\Objects\Login();
            switch ($form->process()) {
                case \App\Objects\Login::STATUS_SUCCESS:
                    header("Location: /home");
                    die();

                    break;

                default :
                    $this->page['content'] = $form->render();
            }
        }
    }

}
