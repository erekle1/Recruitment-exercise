<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\activeRecord\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation'   => true,
    ]); ?>

    <?= $form->field($model, 'first_name')->textInput() ?>

    <?= $form->field($model, 'last_name')->textInput() ?>

    <?= $form->field($model, 'email')->input('email')  ?>

    <?= $form->field($model, 'personal_code')->input('number')  ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'dead')->checkbox() ?>

    <?= $form->field($model, 'lang')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
