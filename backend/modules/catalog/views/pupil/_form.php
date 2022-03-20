<?php

use common\helpers\PupilHelper;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Pupil $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="pupil-form">

    <?php $form = ActiveForm::begin([
            'id' => 'Pupil',
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
            <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'birth_date')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Enter birth date ...'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'dd-mm-yyyy'
                ]
            ]); ?>

            <?= $form->field($model, 'gender')->dropDownList(PupilHelper::getGenderList(), [
                'prompt' => Yii::t('ui', 'Select')
            ]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address')->textarea(['rows' => 2]) ?>

            <?= $form->field($model, 'status')->dropDownList(PupilHelper::getStatusList()) ?>
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
