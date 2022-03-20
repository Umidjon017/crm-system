<?php

use common\helpers\RoomHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Room $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="room-form">
    <?php $form = ActiveForm::begin([
            'id' => 'Room',
            'layout' => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-danger',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    #'offset' => 'col-sm-offset-4',
                    'wrapper' => 'col-sm-8',
                    'error' => '',
                    'hint' => '',
                ],
            ],
        ]
    ); ?>

    <section>
        <div>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'type')->dropDownList(RoomHelper::getTypeList(),[
                'prompt' => Yii::t('ui', 'Select')
            ] )?>

            <?= $form->field($model, 'number_of_students')->textInput() ?>

            <?= $form->field($model, 'status')->dropDownList(RoomHelper::getStatusList()) ?>
        </div>

        <hr/>

        <div class="text-center">
            <?php echo $form->errorSummary($model); ?>

            <?= Html::submitButton(
                '<span class="glyphicon glyphicon-check"></span> ' .
                ($model->isNewRecord ? 'Create' : 'Save'),
                [
                    'id' => 'save-' . $model->formName(),
                    'class' => 'btn btn-success'
                ]
            ); ?>

            <?php ActiveForm::end(); ?>
        </div>
    </section>
</div>