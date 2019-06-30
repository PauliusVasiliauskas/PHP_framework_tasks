<?php
namespace App\Objects;

class Logout extends \Core\Page\Objects\Form {

    public function __construct() {
        parent::__construct([
            'fields' => [],
            'validate' => [],
            'buttons' => [
                'submit' => [
                    'text' => 'Logout'
                ]
            ],
        ]);
    }

}