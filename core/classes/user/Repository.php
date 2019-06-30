<?php

namespace Core\User;

class Repository extends \Core\User\Abstracts\Repository {

    protected $model;

    public function __construct(\Core\Database\Connection $c) {
        $this->model = new \Core\User\Model($c);
    }

    public function register(\Core\User\User $user) {
        if (!$this->exists($user)) {
            $this->insert($user);

            return self::REGISTER_SUCCESS;
        }

        return self::REGISTER_ERR_EXISTS;
    }

    public function insert(\Core\User\User $user) {
        return $this->model->insertIfNotExists(
                        $user->getData(), ['email']
        );
    }

    public function load($email) {
        $rows = $this->model->load([
            'email' => $email
        ]);

        foreach ($rows as $row) {
            return new \Core\User\User($row);
        }
    }

    public function loadAll() {
        $rows = $this->model->load();
        $users = [];

        foreach ($rows as $row) {
            $users[] = new \Core\User\User($row);
        }

        return $users;
    }

    public function update(\Core\User\User $user) {
        return $this->model->update($user->getData(), [
                    'email' => $user->getEmail()
        ]);
    }

    public function delete(\Core\User\User $user) {
        return $this->model->delete([
                    'email' => $user->getEmail()
        ]);
    }

    public function deleteAll() {
        return $this->model->delete();
    }

    public function exists($email) {
        $this->model->exists([
            'email' => $email
        ]);
    }

}
