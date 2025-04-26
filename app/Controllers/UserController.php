<?php

namespace App\Controllers;

use App\QueryBuilder;
use Delight\Auth\Auth;
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
        if (!$this->auth->hasRole('admin') && $this->auth->id() != $vars['id']) {
            Flash::error('Можно редактировать только свой аккаунт');
            header('Location: /users');
            exit();
        }
        $user = $this->qb->getOne('users', $vars['id']);
        echo $this->templates->render('page_edit', ['user' => $user]);
    }

    public function update($data): void
    {
        $this->qb->update('users', $data, $this->auth->id());
        header('Location: /users');
        exit();
    }
}