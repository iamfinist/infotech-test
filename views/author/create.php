<?php

/**
 * @var yii\web\View $this
 * @var Author $model
 */

use app\models\Author;

$this->title = 'Create author';

?>
<div class="site-index">

    <div class="body-content">
        <?= $this->render('_form', [
            'model' => $model
        ]) ?>
    </div>
</div>
