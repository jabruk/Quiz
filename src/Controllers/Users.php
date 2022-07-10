<?php

namespace Quiz\Controllers;

use Laminas\Db\TableGateway\TableGateway;

class Users 
{
    public function run()
    {
        $adapter = \Quiz\Service\DB::getAdapter();
        $table = new TableGateway('users',$adapter);
        $stmt = $table->select(['privilege' => 0]);
        $data = [];
        foreach($stmt as $user){
            $data [] = $user;
        }

        $view = new \Quiz\View\Users();
        $view->render([
            'title' => 'Users',
            'data' => $data,
        ]);
    }

    public function runAdd()
    {
        $adapter = \Quiz\Service\DB::getAdapter();
        $validator = $this->getValidator();
        if($_POST && $validator->check($_POST)){ 
            $table = new TableGateway('users',$adapter);
            $table->insert(['email' => $_POST['email'], 'name' => $_POST['name'],'password' => sha1($_POST['password']), 'privilege' => $_POST['privilege']]);
          
            header('Location: /users');
            return;
        }
        $view = new \Quiz\View\Users\Form();
        $view->render([
            'title' => 'Add a new user',
            'data' => $_POST,
            'messages' => $validator->getMessages(),
        ]);
    }

    private function getValidator($isUpdate = false) 
    {
        $validator = new \Quiz\Service\Validator();
        $validator
            ->setRule('email', function($value){
                return ! is_null($value) && mb_strlen($value) > 0;
            }, 'Это поле обязательное')
            ->setRule('email', function($value){
                return preg_match('/^[^@]+@[^@]+$/', $value);
            }, 'Неправильный адрес электронной почты')
            ->setRule('name', function($value){
                return preg_match('/.{2,50}/', $value);
            }, 'Некорректно заполнено поле "Фамилия, Имя"')
            ->setRule('privilege', function($value){
                return in_array((int)$value, [0,1]);
            }, 'Неверное значение привилегии')
            ->setRule('confirm-password', function($value, $data){
                return isset($data['password']) && $data['password'] === $value;
            }, 'Введенный пароль не соответствует оригиналу');

            if($isUpdate){
                $validator->setRule('password', function($value){
                        return $value == '' || preg_match('/.{8,100}/', $value);
                    }, 'Пароль должен быть длиною от 8 до 100 символов');
            } else {
                $validator->setRule('password', function($value){
                        return preg_match('/.{8,100}/', $value);
                    }, 'Пароль должен быть длиною от 8 до 100 символов');
            }

        return $validator;
    }
    
}