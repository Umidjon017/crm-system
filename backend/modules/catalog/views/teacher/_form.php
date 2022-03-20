<?php

use common\helpers\TeacherHelper;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/**
 * @var yii\web\View $this
 * @var common\models\Teacher $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="teacher-form">

    <?php $form = ActiveForm::begin([
            'id' => 'Teacher',
            'options' => ['enctype' => 'multipart/form-data'],
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

            <?= $form->field($model, 'gender')->dropDownList(TeacherHelper::getGenderList(), ['prompt' => Yii::t('ui', 'Choose...')]) ?>

            <?= $form->field($model, 'birth_date')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Enter birth date ...'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'dd-mm-yyyy'
                ]
            ]); ?>

            <?= $form->field($model, 'phone')->textInput(['rows' => 2]) ?>

            <?= $form->field($model, 'photoFile')->fileInput([
                'accept' => "image/png , image/jpeg"
            ]) ?>

            <!-- attribute address -->
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
            <!-- attribute status -->
            <?= $form->field($model, 'status')->dropDownList(TeacherHelper::getStatusList()) ?>
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

