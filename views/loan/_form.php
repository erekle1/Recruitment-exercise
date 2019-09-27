<?php

use app\assets\LoanFormAssets;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Loan */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile('@web/scss/pages/loan/form.css');
LoanFormAssets::register($this);
?>

<div class="loan-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation'   => true,
    ]); ?>

    <?= $form->field($model, 'user_id')->input('number') ?>

    <?= $form->field($model, 'amount')->input('number') ?>

    <?= $form->field($model, 'interest')->input('number') ?>

    <?= $form->field($model, 'duration')->input('number') ?>

    <?= $form->field($model, 'start_date')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput() ?>

    <?= $form->field($model, 'campaign')->textInput() ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
