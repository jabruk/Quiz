<?php

namespace Quiz\View\Tasks;

class Form extends \Quiz\View\Main
{
    public function content(array $data)
    {
        //var_dump($data['questions']); die();
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="block">
                    <div class="block-content block-content-narrow">
                        <form class="form-horizontal push-10-t" action="<?= '/tasks/start?id=' . $_GET['id'] ?>" method="post">
                            <div class="form-group <?= isset($data['messages']['title']) ? 'has-error' : '' ?>">
                                <?php foreach($data['questions'] as $array): ?>
                                    <label class="col-sm-9"><?=$array['text_question'] ?></label>
                                        <div class="col-sm-9">
                                            <?php foreach($data['answers'] as $ans ) : ?>
                                                    <?php if($ans['id_question'] === $array['id']):  ?>
                                                    <div class="checkbox">
                                                        <label for=<?=$ans['id_t'] ?>>
                                                            <input type="checkbox" id=<?=$ans['id_t']?> name=<?='example-checkbox'.$ans['id_t'] ?> value=<?="a".$ans['id_t']?>> <?= $ans['text_answer'] ?>
                                                        </label>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                        </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9">
                                    <button class="btn btn-sm btn-primary" type="submit"><?= 'Finish' ?></button>
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