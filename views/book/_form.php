<?php

/**
 * @var yii\web\View $this
 * @var Book $model
 */

use app\models\Book;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="row">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publication_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'authors_ids[]')->dropDownList(\app\models\Author::getDropdownList(), ['multiple' => true, 'value' => $model->authors_ids])->label('Authors') ?>

    <span>Cover</span>
    <?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
