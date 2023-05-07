<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Users $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'gmail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password[]')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password[]')->passwordInput(['maxlength' => true])->label('تکرار گذرواژه') ?>

    <div class="help-block">
      <?= $erorr ?>
    </div>

    <?= $form->field($model, 'date')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('ثبت نام', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>