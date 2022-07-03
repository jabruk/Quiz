<?php

namespace Quiz\View;

class Results extends Main
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
            'score' => [
                'label' => 'Result',
                'class' => '',
                'style' => ''
            ],
        ];
    }

}
