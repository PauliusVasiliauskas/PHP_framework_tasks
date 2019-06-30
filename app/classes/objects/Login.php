<?php

namespace App\Objects;

class Login extends \Core\Page\Objects\Form {

    public function __construct() {
        parent::__construct([
            'fields' => [
                'email' => [
                    'label' => 'Email',
                    'type' => 'text',
                    'placeholder' => 'email@gmail.com',
                    'validate' => [
                        'validate_not_empty',
                        'validate_email'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'type' => 'password',
                    'placeholder' => '********',
                    'validate' => [
                        'validate_not_empty'
                    ]
                ]
            ],
            'validate' => [
                'validate_login'
            ],
            'buttons' => [
                'submit' => [
                    'text' => 'Login'
                ]
            ],
        ]);
    }

}
