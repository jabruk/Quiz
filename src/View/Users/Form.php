<?php

namespace Quiz\View\Users;

class Form extends \Quiz\View\Main
{
    public function content(array $data = [])
    {
        $isNew = ! isset($data['data']['id']);
        ?>
        <div class="row">`
            <div class="col-lg-12">
                <div class="block">
                    <div class="block-content block-content-narrow">
                        <form class="form-horizontal push-10-t" action="<?= $isNew ? '/users/add' : '/users/update?id=' . $data['data']['id'] ?>" method="post">
                            <div class="form-group <?= isset($data['messages']['email']) ? 'has-error' : '' ?>">
                                <div class="col-sm-9">
                                    <div class="form-material">
                                        <input class="form-control" type="email" id="material-email" name="email" placeholder="Введите email" value = "<?= $data['data']['email'] ?? '' ?>">
                                        <label for="material-email">Email</label>
                                        <?php if (isset($data['messages']['email'])): ?>
                                            <div class="help-block"><?= $data['messages']['email'] ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?= isset($data['messages']['password']) ? 'has-error' : '' ?>">
                                <div class="col-sm-9">
                                    <div class="form-material">
                                        <input class="form-control" type="password" id="material-password" name="password" placeholder="Enter your password">
                                        <label for="material-password">Password</label>
                                        <?php if (isset($data['messages']['password'])): ?>
                                            <div class="help-block"><?= $data['messages']['password'] ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?= isset($data['messages']['confirm-password']) ? 'has-error' : '' ?>">
                                <div class="col-sm-9">
                                    <div class="form-material">
                                        <input class="form-control" type="password" id="material-password" name="confirm-password" placeholder="Repeat your password">
                                        <label for="material-password">repeat your password</label>
                                        <?php if (isset($data['messages']['confirm-password'])): ?>
                                            <div class="help-block"><?= $data['messages']['confirm-password'] ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?= isset($data['messages']['name']) ? 'has-error' : ''?>">
                                <div class="col-sm-9">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="material-text" name="name" placeholder="Input your name and lastname" value = "<?= $data['data']['name'] ?? '' ?>">
                                        <label for="material-text">Name, Lastname </label>
                                        <?php if (isset($data['messages']['name'])): ?>
                                            <div class="help-block"><?= $data['messages']['name'] ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?= isset($data['messages']['privilege']) ? 'has-error' : ''?>">
                                <div class="col-sm-9">
                                    <div class="form-material">
                                        <select class="form-control" id="material-select" name="privilege" size="1">
                                            <option value="0">Student</option>
                                            <option value="1">Teacher</option>
                                        </select>
                                        <label for="material-select">Privilege</label>
                                        <?php if (isset($data['messages']['privilege'])): ?>
                                            <div class="help-block"><?= $data['messages']['privilege'] ?></div>
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