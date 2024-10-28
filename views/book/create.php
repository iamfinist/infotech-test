<?php

/**
 * @var yii\web\View $this
 * @var Book $model
 */

use app\models\Book;

$this->title = 'Create book';

?>
<div class="site-index">

    <div class="body-content">
        <?= $this->render('_form', [
            'model' => $model
        ]) ?>
    </div>
</div>
