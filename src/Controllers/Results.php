<?php

namespace Quiz\Controllers;

use Laminas\Db\Sql\Sql;
use Laminas\Db\TableGateway\TableGateway;

class Results 
{
    public function run()
    {

        /**SELECT  
                `tests`.*,
                `test_history`.`score`
            FROM    
                `tests`
            LEFT JOIN
                `test_history`
                ON `tests`.`id` = `test_history`.`id_test` */
        $adapter = \Quiz\Service\DB::getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select
                ->from(['t' => 'tests'])
                ->join(['t_h' => 'test_history'], 't.id = t_h.id_test',array('score','id_student'),'left')
                ->where(['id_student' => $_SESSION['auth']['id']]);
       

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        $arr = [];
        foreach($result as $ar){
            $arr [] = $ar;
        }
        //var_dump($arr);die();
        $i = 0;
        $n = count($arr);
        foreach($arr as $score){
        
            
            if($score['id'] == $arr[$i + 1]['id']){
                unset($arr[$i]);
            }
            $i++;
            if($i >= $n - 1) break;
        }
        
        $view = new \Quiz\View\Results();
        $view->render([
            'title' => 'Results',
            'data' => $arr,
        ]);
    }
}