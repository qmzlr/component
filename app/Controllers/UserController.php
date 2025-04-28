<?php

namespace App\Controllers;

use App\QueryBuilder;
use Delight\Auth\Auth;
use Delight\Auth\Role;
use JetBrains\PhpStorm\NoReturn;
use League\Plates\Engine;
use Tamtamchik\SimpleFlash\Flash;

class UserController
{
    protected Engine $templates;
    protected Auth $auth;
    protected QueryBuilder $qb;

    public function __construct(QueryBuilder $qb, Engine $engine, Auth $auth)
    {
        $this->qb = $qb;
        $this->templates = $engine;
        $this->auth = $auth;
    }

    public function index($vars): void
    {
        if (!$this->auth->isLoggedIn()) {
            header('Location: /login');
            exit();
        }
        if (!$this->auth->hasRole(Role::ADMIN) && $this->auth->id() != $vars['id']) {
            Flash::error('Можно редактировать только свой аккаунт');
            header('Location: /users');
            exit();
        }
        $user = $this->qb->getOne('users', $vars['id']);
        echo $this->templates->render('page_edit', ['user' => $user]);
    }

    #[NoReturn] public function update($data): void
    {
        $this->qb->update('users', $data, $this->auth->id());
        header('Location: /users');
        exit();
    }

    public function newUser(): void
    {
        if (!$this->auth->hasRole(Role::ADMIN)) {
            header('Location: /users');
            exit();
        }
        echo $this->templates->render('page_create_user');
    }

    #[NoReturn] public function createUser($data): void
    {
        try {
            $newUserId = $this->auth->admin()->createUser($data['email'], $data['password'], $data['username']);
            unset($data['email'], $data['password'], $data['username']);
            $this->qb->update('users', $data, $newUserId);
            Flash::success('User created');
            header('Location: /users');
            exit();
        } catch (\Delight\Auth\InvalidEmailException $e) {
            Flash::error('Invalid email address');
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            Flash::error('Invalid password');
        } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            Flash::error('User already exists');
        }
    }
}