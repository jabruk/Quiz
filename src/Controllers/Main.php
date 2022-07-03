<?php

namespace Quiz\Controllers;

class Main
{
    public function run(){
        $view = new \Quiz\View\Main();
        $view->render([
            'title' => 'Main Page',
        ]);
    }
}