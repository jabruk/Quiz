<?php

namespace Quiz\Controllers;

class StudentResults 
{
    public function run()
    {
        $db = \Quiz\Service\DB::get();

        $stmt2 = $db->prepare("
            SELECT  
                `test_history`.`id_student`,`id_test`,`score`,
                `users`.`name`
            FROM    
                `test_history`
            LEFT JOIN
                `users`
                ON `test_history`.`id_student` = `users`.`id`
        "); 

        $stmt2->execute();



        $arr = $stmt2->fetchAll();

        $n = count($arr);
        for ($i = 0; $i < $n; $i++){
            for($j = $i+1; $j < $n; $j++){
                if ($arr[$i]['id_test'] == $arr[$j]['id_test'] && $i != $j){
                    if($arr[$i]['score'] < $arr[$j]['score']){
                        unset($arr[$i]);
                        break;
                    }
                    else{
                        unset($arr[$j]);
                        break;
                    }
                }
            }
        }
   
        $view = new \Quiz\View\StudentResults();
        $view->render([
            'title' => 'Results',
            'data' => $arr
        ]);
    }
}