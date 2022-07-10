<?php

namespace Quiz\View\Question;

class Form extends \Quiz\View\Main
{
    public function content(array $data = [])
    {
        $isNew = !isset($data['data']['name']);
        var_dump($data);
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="block">
                    <div class="block-content block-content-narrow">
                        <form class="form-horizontal push-10-t" action="/tests/questions" method="post">
                            <div class="form-group <?= isset($data['messages']['title']) ? 'has-error' : '' ?>">
                                <div class="col-sm-9">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="material-name" name="name" placeholder="Input name" value="">
                                        <label for="material-name">Questions name</label>
                                        <?php if (isset($data['messages']['name'])) : ?>
                                            <div class="help-block"><?= $data['messages']['name'] ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?= isset($data['messages']['title']) ? 'has-error' : '' ?>">
                                <div class="f1">
                                    <p>Поле 1: <input type="text" class="ninput" id="in1" name="q1" /><input type="checkbox" value="0" name="a1"></p>
                                    
                                </div>
                                <p><button type="button" id="1b" onClick='func()'>Добавить поле</button></p>
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

        <script>
            const func = () => {
                const inputs = document.querySelectorAll('input[type="text"]');
                const forms = document.querySelectorAll('.f1')[0];
                forms.appendChild(
                    createElementFromHTML(
                        `<p>Поле ${inputs.length-1} : <input type="text" name="q${inputs.length-1}" id="in${
                    inputs.length-1
                }" class="ninput"> <input type="checkbox" checked value="1" name="a${inputs.length - 1}">"</p>`
                    )
                );
            };

            function createElementFromHTML(htmlString) {
                var div = document.createElement('div');
                div.innerHTML = htmlString.trim();
                return div.firstChild;
            }
        </script>
    <?php
    }
}

?>