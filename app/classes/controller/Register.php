<?php

namespace App\Controller;

class Register extends Base {

    /**
     *
     * @var type \App\Objects\Form\Register
     */
    protected $form;

    public function __construct() {
        parent::__construct();
        /* $view = new \Core\Page\View(
          [
          'title' => 'Kažka ten apie kregždes',
          'content' => 'asdasfdasd'
          ]); */
        $this->page ['title'] = 'Register';
        $this->form = new \App\Objects\Register();
        switch ($this->form->process()) {
            case \App\Objects\Register::STATUS_SUCCESS:
                $this->registerSuccess();
                header("Location: /home");
                die();

                break;

            default :
                $this->page['content'] = $this->form->render();
        }
//        $this->page['content'] = $view->render(ROOT_DIR . '/app/views/content.tpl.php');
    }

    function registerSuccess() {
        $safe_input = $this->form->getInput();
        $user = new \Core\User\User([
            'email' => $safe_input['email'],
            'password' => password_hash($safe_input['password'], PASSWORD_BCRYPT),
            'full_name' => $safe_input['full_name'],
            'age' => $safe_input['age'],
            'gender' => $safe_input['gender'],
            'orientation' => $safe_input['orientation'],
            'account_type' => \Core\User\User::ACCOUNT_TYPE_USER,
            'photo' => $safe_input['photo'],
            'is_active' => true
        ]);

        \App\App::$user_repo->insert($user);
    }

}
