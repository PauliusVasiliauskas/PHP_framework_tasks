<?php

require_once '../bootloader.php';

function validate_user_exists($field_input, &$field, &$safe_input) {

    if (!\App\App::$user_repo->exists($field_input)) {
        return true;
    } else {
        $field['error_msg'] = 'Error, a user with this email already exists';
    }
}

function validate_string_lenght_10_chars($field_input, &$field, &$safe_input) {
    if (strlen($field_input) > 10) {
        return true;
    } else {
        $field['error_msg'] = strtr('Error, '
                . '@field must be longer than 10 symbols', ['@field' => $field['label']
        ]);
    }
}

function validate_string_lenght_60_chars($field_input, &$field, &$safe_input) {
    if (strlen($field_input) < 60) {
        return true;
    } else {
        $field['error_msg'] = strtr('Error, '
                . '@field must be shorter than 60 symbols', ['@field' => $field['label']
        ]);
    }
}

function validate_login(&$safe_input, &$form) {
    $status = \App\App::$session->login($safe_input['email'], $safe_input['password']);
    switch ($status) {
        case Core\User\Session::LOGIN_SUCCESS:
            return true;
    }

    $form['error_msg'] = 'Error, bad email/password';
}

function validate_password(&$safe_input, &$form) {
    if ($safe_input['password'] === $safe_input['password_again']) {
        return true;
    } else {
        $form['error_msg'] = 'Error, passwords do not match';
    }
}

function validate_form_file(&$safe_input, &$form) {
    $file_saved_url = save_file($safe_input['photo']);
    if ($file_saved_url) {
        $safe_input['photo'] = 'uploads/' . $file_saved_url;
        return true;
    } else {
        $form['error_msg'] = 'Error, uploaded wrong file';
    }
}

function save_file($file, $dir = 'uploads', $allowed_types = ['image/png', 'image/jpeg', 'image/gif']) {
    if ($file['error'] == 0 && in_array($file['type'], $allowed_types)) {
        $target_file_name = microtime() . '-' . strtolower($file['name']);
        $target_path = $dir . '/' . $target_file_name;
        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            return $target_file_name;
        }
    }
    return false;
}
