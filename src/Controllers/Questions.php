<?php

namespace Quiz\Controllers;

use Laminas\Db\TableGateway\TableGateway;

class Questions 
{

    
    public function run()
    {
        
        $adapter = \Quiz\Service\DB::getAdapter();
        
        if($_POST){



            //die();
            $table = new TableGateway('questions', $adapter);
            $table->insert(['id_test' => $_SESSION['test_info']['id'], 'text_question' => $_POST['name']]);
 
                

            $lastId = $adapter->getDriver()->getLastGeneratedValue();

            foreach($_POST as $ans => $def){
                if(substr($ans,0,1) === "q" ){
                    $table = new TableGateway('answers', $adapter);
                    $stmt = $table->insert(['id_question' => $lastId, 'text_answer' => $_POST[$ans], 'correct' => isset($_POST['a' . substr($ans,1,mb_strlen($ans))]) ? 1 : 0]);
            


                }
            }
            
                

        }
        
        $view = new \Quiz\View\Question\Form();
        $view->render([
            'title' => 'Create a question',
            'name' => $_SESSION['test_info']['name'],
        ]);
    }
    
    


    private function getValidator() 
    {
        $validator = new \Quiz\Service\Validator();
        $validator->setRule('name', function($value){
            $db = \Quiz\Service\DB::getAdapter();
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
        $db = \Quiz\Service\DB::getAdapter();
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