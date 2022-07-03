<?php

namespace Quiz\View\Tasks;

class Form extends \Quiz\View\Main
{
    public function content(array $data)
    {
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
                                                <?php foreach($ans as $text_ans) : ?>
                                                    <?php if($text_ans['id_question'] != $array['id']) break;  ?>
                                                    <div class="checkbox">
                                                        <label for=<?=$text_ans['id'] ?>>
                                                            <input type="checkbox" id=<?=$text_ans['id']?> name=<?='example-checkbox'.$text_ans['id'] ?> value=<?="a".$text_ans['id']?>> <?= $text_ans['text_answer'] ?>
                                                        </label>
                                                    </div>
                                                    <?php endforeach; ?>
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