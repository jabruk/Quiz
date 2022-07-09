<?php

namespace Quiz\Controllers;

use Laminas\Db\TableGateway\TableGateway;

class Tasks
{
    public function run()
    {
        $adapter = \Quiz\Service\DB::getAdapter();
        $table = new TableGateway('tests',$adapter);
        $stmt = $table->select();
        $data = [];
        foreach($stmt as $test){
            $data [] = $test;
        }

        $view = new \Quiz\View\Tasks();
        $view->render([
            'title' => 'Pass tests',
            'data' => $data,
        ]);
    }

    public function runStart()
    {

        $adapter = \Quiz\Service\DB::getAdapter();
        $table = new TableGateway('questions',$adapter);
        $tableAns = new TableGateway('answers',$adapter);
        $tableHistory = new TableGateway('test_history',$adapter);

        $stmt = $table->select(['id_test' => $_GET['id']]);
        

        $question_array = [];
        foreach($stmt as $qw){
            $question_array [] = $qw;
        }

        $answer_array = [];

        foreach ($question_array as $question) {
            $stmt = $tableAns->select(['id_question' => $question['id']]);
            $answers = [];
            foreach($stmt as $qw){
                $answers [] = $qw;
            }
            $answer_array[] = $answers;
        }
        if ($_POST) {
            $cnt = 0;
            foreach ($_POST as $ans => $def) {
                foreach ($answer_array as $ans_arr) {
                    foreach ($ans_arr as $correct) {
                        if (substr($def, 1) == $correct['id'] && $correct['correct'] === 1) {
                            $cnt++;
                        }
                    }
                }
                $tableHistory->insert(['id_student' => $_SESSION['auth']['id'],'id_test' => $_GET['id'],'student_answers' => $_POST[$ans],'score' =>$cnt]);
                
            }

            header('Location: /tasks');
            return;
        }

        $view = new \Quiz\View\Tasks\Form();
        $view->render([
            'title' => 'Test',
            'questions' => $question_array,
            'answers' => $answer_array,
        ]);
    }
}
