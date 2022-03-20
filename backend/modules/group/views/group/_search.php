<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var common\models\search\GroupSearch $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="group-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'name') ?>

		<?= $form->field($model, 'subject_id') ?>

		<?= $form->field($model, 'teacher_id') ?>

		<?= $form->field($model, 'level') ?>

		<?php // echo $form->field($model, 'action') ?>

		<?php // echo $form->field($model, 'type') ?>

		<?php // echo $form->field($model, 'price') ?>

		<?php // echo $form->field($model, 'period_start') ?>

		<?php // echo $form->field($model, 'duration') ?>

		<?php // echo $form->field($model, 'start_hour') ?>

		<?php // echo $form->field($model, 'end_hour') ?>

		<?php // echo $form->field($model, 'status') ?>

		<?php // echo $form->field($model, 'is_deleted') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

		<?php // echo $form->field($model, 'created_by') ?>

		<?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
