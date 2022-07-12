<?php

namespace Quiz\Controllers;

use Laminas\Db\Sql\Sql;
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

        $tableHistory = new TableGateway('test_history',$adapter);


        $sql = new Sql($adapter);
        $select = $sql->select();
        $select
                ->from(['q' => 'questions'])
                ->where(['id_test' => $_GET['id']])
                ->join(['a' => 'answers'] , 'a.id_question = q.id',array('text_answer','correct','id_t' => 'id'),'left');
       

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        $answer_array = [];
        $question_array = [];
        $text_q = '';
        foreach($result as $res){
            if($text_q !== $res['text_question']){    
                $question_array [] = [
                    'id' => $res['id'],
                    'id_test' => $res['id_test'],
                    'text_question' => $res['text_question']
                ];
            }
            $answer_array [] = [
                'text_answer' => $res['text_answer'],
                'correct' => $res['correct'] ,
                'id_question' => $res['id'],
                'id_t' => $res['id_t']
            ];
            $text_q = $res['text_question'];
        }

        if ($_POST) {
            $cnt = 0;
            foreach ($_POST as $ans => $def) {
                foreach ($answer_array as $correct) {
                        if (substr($def, 1) == $correct['id_t'] && $correct['correct'] === 1) {
                            $cnt++;
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
