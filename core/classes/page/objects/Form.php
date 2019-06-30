<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core\Page\Objects;

use \Exception;

class Form {

    protected $form;
    protected $input;

    const STATUS_VALIDATION_FAIL = -1;
    const STATUS_NO_INPUT = 0;
    const STATUS_SUCCESS = 1;

    public function __construct(array $form) {
        $this->form = $form;
    }

    public function get_safe_input() {
        $filtro_parametrai = [
            'action' => FILTER_SANITIZE_SPECIAL_CHARS
        ];
        foreach ($this->form['fields'] as $field_id => $field) {
            $filter_type = $field['filter'] ?? FILTER_SANITIZE_SPECIAL_CHARS;
            $filtro_parametrai[$field_id] = $filter_type;
        }

        return filter_input_array(INPUT_POST, $filtro_parametrai);
    }

    public function process() {
        if (!empty($_POST)) {
            $this->input = $this->get_safe_input();
            $success = $this->validate_form();

            return $success ? self::STATUS_SUCCESS : self::STATUS_VALIDATION_FAIL;
        } else {
            return self::STATUS_NO_INPUT;
        }
    }

    public function validate_form() {
        $success = true;
        $this->form['pre_validate'] = $this->form['pre_validate'] ?? [];

        foreach ($this->form['pre_validate'] as $pre_validator) {
            if (is_callable($pre_validator)) {
                if (!$pre_validator($this->input, $this->form)) {
                    $success = false;
                    break;
                }
            } else {
                throw new Exception(strtr('Not callable @validator function', [
                    '@validator' => $validator
                ]));
            }
        }
        if ($success) {
            foreach ($this->form['fields'] as $field_id => &$field) {
                foreach ($field['validate'] as $validator) {
                    if (is_callable($validator)) {
                        $field['id'] = $field_id;

                        if (!$validator($this->input[$field_id], $field, $this->input)) {
                            $success = false;
                            break;
                        }
                    } else {
                        throw new Exception(strtr('Not callable @validator function', [
                            '@validator' => $validator
                        ]));
                    }
                }
            }
        }
        if ($success) {
            $this->form['validate'] = $this->form['validate'] ?? [];

            foreach ($this->form['validate'] as $validator) {
                if (is_callable($validator)) {
                    if (!$validator($this->input, $this->form)) {
                        $success = false;
                        break;
                    }
                } else {
                    throw new Exception(strtr('Not callable @validator function', [
                        '@validator' => $validator
                    ]));
                }
            }
        }
        return $success;
    }
    
    public function getInput(){
        return $this->input;
    }

    public function render($tpl_path = ROOT_DIR . '/core/views/form.tpl.php') {
        return (new \Core\Page\View($this->form))->render($tpl_path);
    }

}
