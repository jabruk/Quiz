<?php

namespace Quiz\View;

class StudentResults extends Main
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
            'id_student' => [
                'label' => '#',
                'class' => 'text-center',
                'style' => 'width: 50px;'
            ],
            'name' => [
                'label' => 'Student name',
                'class' => '',
                'style' => ''
            ],
            'id_test' => [
                'label' => 'Test #',
                'class' => 'text-center',
                'style' => 'width: 70px;'
            ],
            'score' => [
                'label' => 'Result',
                'class' => 'text-center',
                'style' => ''
            ],
        ];
    }

}
