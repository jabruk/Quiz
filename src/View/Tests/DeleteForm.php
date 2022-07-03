<?php

namespace Quiz\View\Tests ;

class DeleteForm extends \Quiz\View\Main
{
    public function content(array $data)
    {
        ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="block">
                        <div class="block-content block-content-narrow">
                            <form class="form-horizontal push-10-t" action="<?= $data['url']['approve'] ?>" method="post">
                                <input type="hidden" name="id" value="<?= $data['task']['id'] ?>" >
                                <div class="form-group">
                                    <div class="col-sm-9">
                                        <div class="alert alert-danger alert-dismissable">
                                            <h3 class="font-w300 push-15"><?= $data['title'] ?></h3>
                                            <p>Are you sure, you want to delete this test <a class="alert-link" href="javascript:void(0)"><?= $data['task']['name'] ?></a>!?</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-9">
                                        <button class="btn btn-sm btn-primary" type="submit">Delete</button>
                                        <a class="btn btn-sm btn-default" href="<?= $data['url']['cancel'] ?>">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php
    }
}   