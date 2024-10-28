<?php

/**
 * @var yii\web\View $this
 * @var Subscription $model
 * @var int $author_id
 */

use app\models\Subscription;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="row">
    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true, 'type' => 'number']) ?>

    <?= $form->field($model, 'author_id')->hiddenInput(['value' => $author_id])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
