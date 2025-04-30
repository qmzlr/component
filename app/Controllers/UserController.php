<?php

namespace App\Controllers;


use App\QueryBuilder;
use Delight\Auth\Auth;
use Delight\Auth\AuthError;
use Delight\Auth\InvalidPasswordException;
use Delight\Auth\NotLoggedInException;
use Delight\Auth\Role;
use Delight\Auth\UnknownIdException;
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
        $this->helper($vars['id']);
        $user = $this->qb->getOne('users', $vars['id']);
        echo $this->templates->render('page_edit', ['user' => $user]);
    }

    #[NoReturn] public function update($data): void
    {
        $this->qb->update('users', $data, $data['id']);
        header('Location: /users');
        exit();
    }

    public function newUser(): void
    {
        if (!$this->auth->hasRole(Role::ADMIN)) {
            header('Location: /users');
            exit();
        }
        $this->helper($this->auth->id());
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
        } catch (InvalidPasswordException $e) {
            Flash::error('Invalid password');
        } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            Flash::error('User already exists');
        }
        header('Location: /users');
        exit();
    }

    public function profile($vars): void
    {

        $user = $this->qb->getOne('users', $vars['id']);
        echo $this->templates->render('page_profile', ['user' => $user]);
    }

    public function security($vars): void
    {
        $this->helper($vars['id']);
        $user = $this->qb->getOne('users', $vars['id']);
        echo $this->templates->render('page_security', ['user' => $user]);
    }


    public function securityUpdate($data): void
    {
        $user = $this->qb->getOne('users', $data['id']);

        if (!empty($data['email']) && $data['email'] != $user['email']) {
            if ($this->auth->id() == $data['id']) {
                try {
                    $this->auth->changeEmail($data['email'], function ($selector, $token) {
                        $this->auth->confirmEmail($selector, $token);
                    });

                    Flash::success('Email has been changed');
                    header('Location: /users');
                    exit();
                } catch (\Delight\Auth\InvalidEmailException $e) {
                    Flash::error('Invalid email address');
                } catch (\Delight\Auth\UserAlreadyExistsException $e) {
                    Flash::error('Email address already exists');
                } catch (\Delight\Auth\EmailNotVerifiedException $e) {
                    Flash::error('Account not verified');
                } catch (NotLoggedInException $e) {
                    Flash::error('Not logged in');
                } catch (\Delight\Auth\TooManyRequestsException $e) {
                    Flash::error('Too many requests');
                }
            } else {
                Flash::error('Почту может менять только владелец аккаунта');
            }

        }


        if ((!empty($data['password']) && ($data['password'] == $data['passwordConfirm']))) {
            try {
                if ($this->auth->hasRole(Role::ADMIN) && $this->auth->id() != $data['id']) {
                    try {
                        $this->auth->admin()->changePasswordForUserById($data['id'], $data['password']);
                    } catch (UnknownIdException $e) {
                        Flash::error('id not');
                    } catch (InvalidPasswordException $e) {
                        Flash::error('Invalid password(s)');
                    }
                } else {
                    $this->auth->changePasswordWithoutOldPassword($data['password']);
                    Flash::success('Password has been changed');
                    header('Location: /users');
                    exit();
                }
            } catch (NotLoggedInException $e) {
                Flash::error('Not logged in');
            } catch (InvalidPasswordException $e) {
                Flash::error('Invalid password(s)');
            }
        }
        header('Location: /users');
        exit();
    }

    public function status($vars): void
    {
        $this->helper($vars['id']);
        $user = $this->qb->getOne('users', $vars['id']);
        echo $this->templates->render('page_state', ['user' => $user]);
    }

    #[NoReturn] public function statusUpdate($data): void
    {
        $this->qb->update('users', $data, $data['id']);
        Flash::success('Статус успешно изменен');
        header('Location: /users');
        exit();
    }

    public function pageMedia($vars): void
    {
        $this->helper($vars['id']);
        $user = $this->qb->getOne('users', $vars['id']);
        echo $this->templates->render('page_media', ['user' => $user]);
    }

    public function mediaUpdate($data): void
    {
        if (!empty($_FILES['avatar']['tmp_name'])) {
            $user = $this->qb->getOne('users', $data['id']);

            $newPath = $this->moveUploadedFile($_FILES['avatar'], $user['avatar']);

            $data['avatar'] = $newPath;
            $this->qb->update('users', $data, $data['id']);
            Flash::success('Аватарка профиля отредактирован');
            header('Location: /users');
            exit();
        }
    }

    public function delete($vars): void
    {
        $this->helper($vars['id']);
        try {
            $this->auth->admin()->deleteUserById($vars['id']);
            Flash::success('User deleted');
            header('Location: /users');
            exit();
        } catch (UnknownIdException $e) {
            Flash::error('id not');
        }

    }

    private function moveUploadedFile(array $file, string $oldPath): string
    {
        if ($oldPath && file_exists($oldPath)) {
            unlink($oldPath);
        }

        $newPath = '../uploads/' . uniqid() . $file['name'];
        move_uploaded_file($file['tmp_name'], $newPath);

        return $newPath;
    }

    public function helper($id): void
    {
        if (!$this->auth->isLoggedIn() || ($this->auth->id() != $id && !$this->auth->hasRole(Role::ADMIN))) {
            $redirectUrl = $this->auth->isLoggedIn() ? '/users' : '/login';
            $message = $this->auth->isLoggedIn() ? 'Можно редактировать только свой аккаунт' : null;
            if ($message) Flash::error($message);
            header("Location: $redirectUrl");
            exit();
        }
    }

}