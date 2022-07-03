<?php

namespace Quiz\Controllers;

class Tests
{
    public function run()
    {
        $db = \Quiz\Service\DB::get();
        $stmt = $db->prepare("
            SELECT  
                *
            FROM    
                `tests`
        ");

        $stmt->execute();

        $view = new \Quiz\View\Tests();
        $view->render([
            'title' => 'Tests',
            'data' => $stmt->fetchAll(),
        ]);
    }

    public function runAdd()
    {
        $validator = $this->getValidator();

        if ($_POST && $validator->check($_POST)) {

            $db = \Quiz\Service\DB::get();
            $stmt = $db->prepare("
                INSERT INTO
                    `tests` (
                        `name`
                    ) VALUES (
                        :name
                    )
            ");

            $stmt->execute([
                ':name' => $_POST['name'],
            ]);

            $stmt = $db->prepare("
                SELECT
                    *
                FROM
                    `tests`
                WHERE
                    `name` = :name
            ");

            $stmt->execute([
                ':name' => $_POST['name'],
            ]);


            $_SESSION['test_info'] = $stmt->fetch();


            header('Location: /tests/questions');
            return;
        }

        $view = new \Quiz\View\Tests\Form();
        $view->render([
            'title' => 'Create a new test',
            'data' => $_POST,
            'messages' => $validator->getMessages(),
        ]);
    }


    public function runUpdate()
    {



        if (!isset($_GET['id'])) {
            header('Location: /tests');
            return;
        }



        $db = \Quiz\Service\DB::get();

        $question_array = $this->getQuestions();

        $answer_array = $this->getAnswers();

        // if($_POST){
        //     var_dump($_POST);
        //     die();
        // }

        $validator = $this->getValidator(true);
        if ($_POST && $validator->check($_POST)) {

            
            $stmt = $db->prepare("
                UPDATE
                    `tests`
                SET
                    `name` = :name
                WHERE
                    `id` = :id
                    
            ");
            $stmt->execute([
                ':name' => $_POST['name'],
                ':id' => $_GET['id'],
            ]);

            foreach($_POST as $element => $def){
                if(substr($element,0,1) == 'a'){

                    $stmt = $db->prepare("
                    
                        UPDATE
                            `answers`
                        SET
                            `text_answer` = :answer,
                            `correct` = :is_correct
                        WHERE
                            `id` = :id
                    ");
                    $stmt->execute([
                        ':answer' => $def,
                        ':id' => substr($element,1),
                        ':is_correct' => isset($_POST['c'.substr($element,1)]) ? 1 : 0,
                    ]);
                } elseif(substr($element,0,1) == 'q') {
                    $stmt = $db->prepare("
                    
                        UPDATE
                            `questions`
                        SET
                            `text_question` = :question
                        WHERE
                            `id` = :id
                    ");
                    $stmt->execute([
                        ':question' => $def,
                        ':id' => substr($element,1),
                    ]);
                }
            }

            header('Location: /tests');
            return;
        }



        $view = new \Quiz\View\Tests\UpdateForm();
        $view->render([
            'title' => 'Task\'s account editing',
            'questions' => $question_array,
            'answers' => $answer_array,
            'test_name' => $this->getTestName(),
            'messages' => $validator->getMessages(),

        ]);
    }


    public function runAddQuestion(){
        $pdo = \Quiz\Service\DB::get();

        if(isset($_GET)){
            
            $stmt = $pdo->prepare("
            INSERT INTO
                    `questions` (
                        `id_test`,
                        `text_question`
                    ) VALUES (
                        :idt,
                        :tq
                    )
            ");
            $stmt->execute([
                ':idt' => intval($_GET['id']),
                ':tq' => '',



            ]);
            
        header('Location: /tests/update?id='.$_SESSION['test_id']);
            
        $view = new \Quiz\View\Tests\UpdateForm();
        $view->render([
            'title' => 'Task\'s account editing',
            'questions' => $this->getQuestions($_SESSION['test_id']),
            'answers' => $this->getAnswers(),
            'test_name' => $this->getTestName($_SESSION['test_id']),

        ]);
        
        } else {
            header('Location:/tests');
            return;
        }
    }

    public function runDeleteQuestion(){
        $pdo = \Quiz\Service\DB::get();

        if(isset($_GET)){
            $stmt = $pdo->prepare("DELETE FROM `questions` WHERE `id` = :idq");
            $stmt->execute([
                ':idq' => $_GET['id'],

            ]);
            $stmt = $pdo->prepare("DELETE FROM `answers` WHERE `id_question` = :idq");
            $stmt->execute([
                ':idq' => $_GET['id'],

            ]);
            
            $view = new \Quiz\View\Tests\UpdateForm();
            header('Location: /tests/update?id='.$_SESSION['test_id']);
            $view->render([
                'title' => 'Task\'s account editing',
                'questions' => $this->getQuestions($_SESSION['test_id']),
                'answers' => $this->getAnswers(),
                'test_name' => $this->getTestName($_SESSION['test_id']),
    
            ]);
        } else {
            header('Location:/tests');
            return;
        }
    }


    public function runDeleteAnswer(){
        $pdo = \Quiz\Service\DB::get();

        if(isset($_GET)){
            
            $stmt = $pdo->prepare("DELETE FROM `answers` WHERE `id` = :ida ");
            $stmt->execute([
                ':ida' => $_GET['id'],

            ]);
            
            
        $view = new \Quiz\View\Tests\UpdateForm();
        header('Location: /tests/update?id='.$_SESSION['test_id']);
        $view->render([
            'title' => 'Task\'s account editing',
            'questions' => $this->getQuestions($_SESSION['test_id']),
            'answers' => $this->getAnswers(),
            'test_name' => $this->getTestName($_SESSION['test_id']),

        ]);
        } else {
            header('Location:/tests');
            return;
        }
    }

    public function runAddAnswer(){
        $pdo = \Quiz\Service\DB::get();

        if(isset($_GET)){
            
            $stmt = $pdo->prepare("
            INSERT INTO
                    `answers` (
                        `id_question`,
                        `text_answer`,
                        `correct`
                    ) VALUES (
                        :idq,
                        :ta,
                        :ic
                    )
            ");
            $stmt->execute([
                ':idq' => intval($_GET['id']),
                ':ta' => '',
                ':ic' => 0,



            ]);
            
        header('Location: /tests/update?id='.$_SESSION['test_id']);
            
        $view = new \Quiz\View\Tests\UpdateForm();
        $view->render([
            'title' => 'Task\'s account editing',
            'questions' => $this->getQuestions($_SESSION['test_id']),
            'answers' => $this->getAnswers(),
            'test_name' => $this->getTestName($_SESSION['test_id']),

        ]);
        
        } else {
            header('Location:/tests');
            return;
        }
    }

    public function runDelete()
    {

        $pdo = \Quiz\Service\DB::get();

        if (isset($_POST['id'])) {
            // foreach()


            $stmt = $pdo->prepare("SELECT `id` FROM `questions` WHERE `id_test` = :idt ");
            $stmt->execute([
                ':idt' => $_POST['id'],

            ]);

            $arrayOfIdQuestions = $stmt->fetchAll();


            foreach ($arrayOfIdQuestions as $qstn) {

                foreach ($qstn as $id) {
                    $stmt = $pdo->prepare("DELETE FROM `answers` WHERE `id_question` = :idq ");
                    $stmt->execute([
                        ':idq' => $id,
                    ]);
                }
            }

            foreach ($arrayOfIdQuestions as $qstn) {

                $stmt = $pdo->prepare("DELETE FROM `questions` WHERE `id` = :id ");
                $stmt->execute([
                    ':id' => $qstn['id'],
                ]);
            }

            $stmt = $pdo->prepare("DELETE FROM `tests` WHERE `id` = :id ");
            $stmt->execute([
                ':id' => $_POST['id'],
            ]);

            header('Location: /tests');
            return;
        }

        if (!isset($_GET['id'])) {
            header('Location: /tests');
            return;
        }


        $stmt = $pdo->prepare("
            SELECT
                *
            FROM
                `tests`
            WHERE
                `id` = :idt
        
        ");

        $stmt->execute([
            ':idt' => $_GET['id'],
        ]);

        if (!$test = $stmt->fetch()) {
            header('Location: /tests');
            return;
        }



        $view = new \Quiz\View\Tests\DeleteForm();


        $view->render([
            'title' => 'Delete test',
            'task' => $test,
            'url' =>   [
                'approve' => '/tests/delete',
                'cancel' => '/tests',
            ]
        ]);
    }



    private function getValidator($isUpdate = false)
    {
        $validator = new \Quiz\Service\Validator();
        $db = \Quiz\Service\DB::get();
        foreach ($_POST as $id => $def) {



            $validator->setRule($id, function ($value) {

                return !is_null($value) && mb_strlen($value) > 0;
            }, 'You leaved this field empty, returned to the intial set up');

            
            

        }
        $validator->setRule('name', function ($value) {

            return !is_null($value) && mb_strlen($value) > 0;
        }, 'You leaved this field empty, returned to the intial set up');


        return $validator;
    }

    private function getQuestions($id = '')
    {
        $db = \Quiz\Service\DB::get();

        $stmt = $db->prepare("
            SELECT
                *
            FROM    
                `questions`
            WHERE
                `id_test` = :idt
        ");

        $stmt->execute([
            ':idt' => $id == '' ? intval( $_GET['id']) : $id,
        ]);



        return $stmt->fetchAll();
    }

    private function getAnswers()
    {
        $db = \Quiz\Service\DB::get();

        $answer_array = [];
        $stmt = $db->prepare("
                SELECT
                    *
                FROM    
                    `answers`
               
            ");

        $stmt->execute([]);

        $answer_array[] = $stmt->fetchAll();
        return $answer_array;
    }

    private function getTestName($id = '')
    {

        $db = \Quiz\Service\DB::get();

        $stmt = $db->prepare("
            SELECT
                `name`
            FROM    
                `tests`
            WHERE
                `id` = :idt
        ");

        $stmt->execute([
            ':idt' => $id == '' ? intval( $_GET['id']) : $id,

        ]);




        return $stmt->fetchAll();
    }
}
