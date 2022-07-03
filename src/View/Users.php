<?php

namespace Quiz\View;

class Users extends Main
{
    public function content(array $data)
    {
        ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="block">
                        <div class="block-content">
                            <div class="pull-right">
                                <a class="btn btn-primary push-10" href="/users/add"><i class="fa fa-plus"></i></a>
                            </div> 
                            <?php $this->table($this->getColumns(), $data['data']); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }

    private function getColumns()
    {
        return [
            'id' => [
                'label' => '#',
                'class' => 'text-center',
                'style' => 'width: 50px;'
            ],
            'email' => [
                'label' => 'Email',
                'class' => '',
                'style' => ''
            ],
            'name' => [
                'label' => 'Username',
                'class' => '',
                'style' => ''
            ],
            'table-action' => [
                'label' => 'Action',
                'class' => 'text-center',
                'style' => 'width: 200px;',
                'buttons' => [
                    'update' => [
                        'icon' => 'fa fa-pencil',
                        'url' => '/users/update',
                    ],
                    'delete' => [
                        'icon' => 'fa fa-trash',
                        'url' => '/users/delete',
                    ],
                ],
            ],
        ];
    }

}