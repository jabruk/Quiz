<?php

namespace Quiz\Controllers;

use Laminas\Db\Sql\Sql;

class StudentResults 
{
    public function run()
    {
        /**SELECT  
                `test_history`.`id_student`,`id_test`,`score`,
                `users`.`name`
            FROM    
                `test_history`
            LEFT JOIN
                `users`
                ON `test_history`.`id_student` = `users`.`id` */
        $db = \Quiz\Service\DB::getAdapter();
        $sql = new Sql($db);
        $select = $sql->select();
        $select
                ->from(['t' => 'test_history'])
                ->columns(['id_student','id_test','score'])
                ->join(['u' => 'users'], 't.id_student = u.id',array('name'),'left');
       

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        $arr = [];
        foreach($result as $ar){
            $arr [] = $ar;
        }
        $sameArrayButWithoutFirstEl = $arr;


        $i = 0;
        $n = count($arr);
        foreach($arr as $score){
        
            
            if($score['id_student'] == $arr[$i + 1]['id_student']){
                unset($arr[$i]);
            }
            $i++;
            if($i >= $n - 1) break;
        }
        $view = new \Quiz\View\StudentResults();
        $view->render([
            'title' => 'Results',
            'data' => $arr
        ]);
    }
}