<?php

namespace Quiz\Controllers;

use Laminas\Db\TableGateway\TableGateway;

class Results 
{
    public function run()
    {
        $adapter = \Quiz\Service\DB::getAdapter();
        $table = new TableGateway(['tests','test_history'],$adapter);
        die();
        $table->select();
        $stmt = $db->prepare("
            SELECT  
                `tests`.*,
                `test_history`.`score`
            FROM    
                `tests`
            LEFT JOIN
                `test_history`
                ON `tests`.`id` = `test_history`.`id_test`
        "); 
        
        $stmt->execute();
        
        $arr = $stmt->fetchAll();
        $n = count($arr);
        for ($i = 0; $i < $n; $i++){
            for($j = $i+1; $j < $n; $j++){
                if ($arr[$i]['id'] == $arr[$j]['id'] && $i != $j){
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
        $view = new \Quiz\View\Results();
        $view->render([
            'title' => 'Results',
            'data' => $arr,
        ]);
    }
}