<?php

namespace Quiz\View;

class Tasks extends Main
{
    public function content(array $data)
    {
        ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="block">
                        <div class="block-content">
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
            'name' => [
                'label' => 'Test name',
                'class' => '',
                'style' => ''
            ],
            'table-action' => [
                'label' => 'Action',
                'class' => 'text-center',
                'style' => 'width: 200px;',
                'buttons' => [
                    'update' => [
                        'icon' => 'fa fa-play',
                        'url' => '/tasks/start',
                    ]
                ],
            ],
        ];
    }

}