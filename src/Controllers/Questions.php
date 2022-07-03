<?php

namespace Quiz\Controllers;

class Questions 
{

    
    public function run()
    {
        
        $pdo = \Quiz\Service\DB::get();
        
        if($_POST){

            //var_dump($_POST);
            //die();
            $stmt = $pdo->prepare("
            INSERT INTO
                `questions` (
                    `id_test`,
                    `text_question`
                ) VALUES (
                    :idt,
                    :textq
                )
                
            ");

            $stmt->execute([
                ':idt' => $_SESSION['test_info']['id'],
                ':textq' => $_POST['name'],
            ]);
                
            $lastId = $pdo->lastInsertId();

            foreach($_POST as $ans => $def){
                if(substr($ans,0,1) === "q" ){
                    $stmt = $pdo->prepare("
                    INSERT INTO
                        `answers` (
                            `id_question`,
                            `text_answer`,
                            `correct`
                        ) VALUES (
                            :idq,
                            :texta,
                            :is_correct
                        )
                        
                    ");
                    $correct = substr($ans,1,mb_strlen($ans));
                    $correct = "a" . $correct;

                    $stmt->execute([
                        ':idq' => $lastId,
                        ':texta' => $_POST[$ans],
                        ':is_correct' => isset($_POST[$correct]) ? 1 : 0,

                    ]);

                }
            }
            
                

        }
        
        $view = new \Quiz\View\Question\Form();
        $view->render([
            'title' => 'Create a question',
            'name' => $_SESSION['test_info']['name'],
        ]);
    }
    
    

    
    /*
    public function runUpdate()
    {
        if (! isset($_GET['id'])) {
            header('Location: /tasks');
            return;
        }

        $pdo = \Quiz\Service\DB::get();
        $stmt = $pdo->prepare("
            SELECT
                *
            FROM    
                `tasks`
            WHERE 
                `id` = :idt AND `id_user` = :idu
        ");
        $stmt->execute([
            ':idt' => $_GET['id'],
            ':idu' => $_SESSION['auth']['id'],
        ]);

        if (! $task = $stmt->fetch()){
            header('Location: /tasks');
            return;
        }

        $validator = $this->getValidator(true);

        if($_POST && $validator->check($_POST)){
            $stmt = $pdo->prepare("
                UPDATE
                    `tasks`
                SET
                    `id_account` = :ida,
                    `title` = :title,
                    `description` = :desc,
                    `date_plan` = :dplan
                WHERE
                    `id` = :id AND `id_user` = :idu
            ");
            $stmt->execute([
                ':ida' =>$_POST['id_account'],
                ':title' => $_POST['title'],
                ':desc' =>  $_POST['description'],
                ':dplan' => $this->formatDateTime($_POST['date_plan']),
                ':id' =>  $_GET['id'],
                ':idu' =>  $_SESSION['auth']['id'],
            ]);
            header('Location: /tasks');
            return;   
        }

        $view = new \Quiz\View\Tests\Form();
        $view->render([
            'title' => 'Редактирование задачи',
            'data' => $task,
            'messages' => $validator->getMessages(),
            'accounts' => $this->getUserAccounts()
        ]);
    }

    public function runDelete()
    {
        $pdo = \Quiz\Service\DB::get();

        if (isset($_POST['id'])) {
            $stmt = $pdo->prepare("DELETE FROM `tasks` WHERE `id` = :idt AND `id_user` = :idu");
            $stmt->execute([
                ':idt' => $_POST['id'],
                ':idu' => $_SESSION['auth']['id']
            ]);
            header('Location: /tasks');
            return;
        }

        if (! isset($_GET['id'])) {
            header('Location: /tasks');
            return;
        }

        $stmt = $pdo->prepare("
            SELECT
                *
            FROM    
                `tasks`
            WHERE 
                `id` = :id AND `id_user` = :id_user
        ");
        $stmt->execute([
            ':id' => $_GET['id'],
            ':id_user' => $_SESSION['auth']['id']
        ]);

        if (! $task = $stmt->fetch()){
            header('Location: /tasks');
            return;
        }        
        
        $view = new \Quiz\View\Tasks\DeleteForm();
        $view->render([
            'title' => 'Удаление задачи',
            'task' => $task,
            'url' => [
                'Quizrove' => '/tasks/delete',
                'cancel' => '/tasks',
            ]
        ]);
        
    }
    */
    private function getValidator() 
    {
        $validator = new \Quiz\Service\Validator();
        $validator->setRule('name', function($value){
            $db = \Quiz\Service\DB::get();
            $stmt = $db->prepare("
                SELECT  
                    *
                FROM    
                    `tests`
                WHERE
                    `name` = :name
            ");

            $stmt->execute([
                ':name' => $value
            ]);

            if($test = $stmt->fetch()){
                return false;
            }
            else {
                return ! is_null($value) && mb_strlen($value) > 0;
            }
        }, 'Incorrect name or this name is already exist');
        return $validator;
    }
    
    private function getUserAccounts()
    {
        $db = \Quiz\Service\DB::get();
        $stmt = $db->prepare("
            SELECT  
                *
            FROM    
                `tests`
        ");

        $stmt->execute([]);
        
        return $stmt->fetchAll();
    }
}