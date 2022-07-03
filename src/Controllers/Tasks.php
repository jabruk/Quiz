<?php

namespace Quiz\Controllers;

class Tasks
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

        $view = new \Quiz\View\Tasks();
        $view->render([
            'title' => 'Pass tests',
            'data' => $stmt->fetchAll(),
        ]);
    }

    public function runStart()
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
            ':idt' => $_GET['id'],
        ]);

        $question_array = $stmt->fetchAll();

        $answer_array = [];

        foreach ($question_array as $question) {
            $stmt = $db->prepare("
                SELECT
                    *
                FROM    
                    `answers`
                WHERE
                    `id_question` = :idq
            ");

            $stmt->execute([
                ':idq' => $question['id'],
            ]);

            $answer_array[] = $stmt->fetchAll();
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
                $stmt = $db->prepare("
                    INSERT INTO
                        `test_history` (
                            `id_student`,
                            `id_test`,
                            `student_answers`,
                            `score`
                        ) VALUES (
                            :ids,
                            :idt,
                            :sa,
                            :score
                        )   
                ");

                $stmt->execute([
                    ':ids' => $_SESSION['auth']['id'],
                    ':idt' => $_GET['id'],
                    ':sa' => $_POST[$ans],
                    ':score' => $cnt,
                ]);
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
