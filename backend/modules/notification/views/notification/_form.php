<?php

use common\helpers\NotificationHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Notification $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="notification-form">

    <?php $form = ActiveForm::begin([
        'id' => 'Notification',
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
    ]); ?>

    <section>
        <div>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>

            <?= $form->field($model, 'group')->dropDownList(NotificationHelper::getGroupList(), ['prompt' => 'Select ...']) ?>

            <?= $form->field($model, 'status')->dropDownList(NotificationHelper::getStatusList()) ?>
        </div>

        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <div class="text-center">
            <?= Html::submitButton(
                '<span class="glyphicon glyphicon-check"></span> ' .
                ($model->isNewRecord ? 'Create' : 'Save'),
                [
                    'id' => 'save-' . $model->formName(),
                    'class' => 'btn btn-success'
                ]
            ); ?>
        </div>

        <?php ActiveForm::end(); ?>

    </section>

</div>

