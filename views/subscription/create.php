<?php

/**
 * @var yii\web\View $this
 * @var Subscription $model
 * @var int $author_id
 */

use app\models\Subscription;

$this->title = 'Create author';

?>
<div class="site-index">

    <div class="body-content">
        <?= $this->render('_form', [
            'model' => $model,
            'author_id' => $author_id
        ]) ?>
    </div>
</div>
