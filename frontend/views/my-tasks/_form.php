<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Task */
/* @var $form yii\widgets\ActiveForm */
/* @var $templates array */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (!empty($templates)) { ?>
        <?= $form->field($model, 'template_id')->dropDownList($templates, ['prompt'=>'Без шаблона']) ?>
    <?php } ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author_id')->textInput() ?>

    <?= $form->field($model, 'user_responsible_id')->textInput() ?>

    <?= $form->field($model, 'priority')
        ->dropDownList(\common\models\Priority::getTaskPriorities()) ?>

    <?= $form->field($model, 'status')->dropDownList(\frontend\models\Task::getStatusName()) ?>

    <?= $form->field($model, 'is_template')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
