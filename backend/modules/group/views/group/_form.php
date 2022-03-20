<?php

use common\helpers\GroupHelper;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Group $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="group-form">

    <?php $form = ActiveForm::begin([
        'id' => 'Group',
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
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'subject_id')->dropDownList(GroupHelper::getSubjectList())?>

            <?= $form->field($model, 'teacher_id')->dropDownList(GroupHelper::getTeacherList())?>

            <?= $form->field($model, 'level')->dropDownList(GroupHelper::getLevelList()) ?>

            <?= $form->field($model, 'action')->dropDownList(GroupHelper::getActionList(), ['prompt' => 'Select ...']) ?>

            <?= $form->field($model, 'type')->dropDownList(GroupHelper::getTypeList(), ['prompt' => 'Select ...']) ?>

            <?= $form->field($model, 'price')->textInput() ?>

            <?= $form->field($model, 'period_start')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Enter event time ...'],
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ]); ?>

            <?= $form->field($model, 'duration')->dropDownList(GroupHelper::getDurationList()) ?>

            <div class="container">
                <div class="row ">
                    <div class="col-md-6">
                        <?= $form->field($model, 'start_hour')->widget(TimePicker::classname(), []) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'end_hour')->widget(TimePicker::classname(), []) ?>
                    </div>
                </div>
            </div>

            <?= $form->field($model, 'status')->dropDownList(GroupHelper::getStatusList()) ?>
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

    </section>

    <?php ActiveForm::end(); ?>

</div>
