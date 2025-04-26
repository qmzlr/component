<?php

namespace App\Controllers;

use App\QueryBuilder;
use Delight\Auth\Auth;
use Delight\Auth\AuthError;
use JetBrains\PhpStorm\NoReturn;
use League\Plates\Engine;
use Tamtamchik\SimpleFlash\Flash;

class IndexController
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

    #[NoReturn] public function index(): void
    {
        echo 'index';
        if (!$this->auth->isLoggedIn()) {
            echo $this->templates->render('page_register', ['flash' => Flash::display()]);
        } else {
            echo $this->templates->render('page_users', ['flash' => Flash::display()]);
        }
        exit;
    }

    public function login(): void
    {
        echo $this->templates->render('page_login', ['flash' => Flash::display()]);
    }

    public function authorization($data): void
    {
        try {
            $this->auth->login($data['email'], $data['password']);
            header('Location: /users');
            exit();
        } catch (\Delight\Auth\InvalidEmailException $e) {
            Flash::error('Wrong email address');
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            Flash::error('Wrong password');
        } catch (\Delight\Auth\EmailNotVerifiedException $e) {
            Flash::error('Email not verified');
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            Flash::error('Too many requests');
        }
        header('Location: /login');
        exit();
    }

    public function registration($data): void
    {
        try {
            $userId = $this->auth->register($data['email'], $data['password'], $data['username'] ?? null, function ($selector, $token) {
                $this->auth->confirmEmail($selector, $token);
            });
            Flash::success('Registration successful');
            header('Location: /login');
            exit();
        } catch (\Delight\Auth\InvalidEmailException $e) {
            Flash::error('Invalid email address');
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            Flash::error('Invalid password');
        } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            Flash::error('User already exists');
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            Flash::error('Too many requests');
        }
        header('Location: /');
        exit();


    }
}