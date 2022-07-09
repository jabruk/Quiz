<?php

namespace Quiz\Controllers;


use Laminas\Db\TableGateway\TableGateway;

class Login
{
    public function run()
    {
        $message = null;
        if (isset($_POST['email'], $_POST['password'])) {
            $adapter = \Quiz\Service\DB::getAdapter();
            
            $table = new TableGateway('users', $adapter);
            $user = $table->select(['email' => $_POST['email'],'password' => sha1($_POST['password'])]);

            
         

            if ($user->current()) {
                $_SESSION['auth'] = (array)$user->current(); 
                header('Location: /');
                return;
            } else {
                $message = 'Вы ввели неверные данные, пожалуйста перепроверьте и попробуйте снова.';
            }
        }

        $view = new \Quiz\View\Login();
        $view->render();
    }
    public function runLogout()
    {
        unset($_SESSION['auth']);
        header('Location: /');
    }
}
