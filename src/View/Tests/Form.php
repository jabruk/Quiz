<?php

namespace Quiz\View\Tests;

class Form extends \Quiz\View\Main
{
    public function content(array $data = [])

    {

        $isNew = ! isset($data['data']['id']);
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="block">
                    <div class="block-content block-content-narrow">
                        <form class="form-horizontal push-10-t" action="/tests/add" method="post">
                            <div class="form-group <?= isset($data['messages']['title']) ? 'has-error' : '' ?>">
                                <div class="col-sm-9">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="material-name" name="name" placeholder="Input name" value = "<?= $data['data']['name'] ?? '' ?>">
                                        <label for="material-name">Test name</label>
                                        <?php if (isset($data['messages']['name'])): ?>
                                            <div class="help-block"><?= $data['messages']['name'] ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9">
                                    <button class="btn btn-sm btn-primary" type="submit"><?= $isNew ? 'Create' : 'Save' ?></button>
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