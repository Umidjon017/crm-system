<?php

use common\helpers\GroupHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\MaskedInput;

/**
 * @var yii\web\View $this
 * @var common\models\Group $model
 * @var \backend\modules\group\forms\GroupUpdateForm $updateForm
 */

$this->title = Yii::t('models', 'Group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Group'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="group-update">

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-file"></span> ' . Yii::t('ui', "More information"), ['view', 'id' => $model->id], ['class' => 'btn btn-info']) ?>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> '
                . Yii::t('ui', "Full list"), ['index'], ['class' => 'btn btn-warning']) ?>
        </div>
    </div>


    <hr/>

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
                <?= $form->field($updateForm, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($updateForm, 'subject_id')->widget(Select2::class, [
                    'data' => GroupHelper::getSubjectList(),
                    'options' => ['placeholder' => 'Select subject'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>

                <?= $form->field($updateForm, 'teacher_id')->widget(Select2::class, [
                    'data' => GroupHelper::getTeacherList(),
                    'options' => ['placeholder' => 'Select...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>

                <?= $form->field($updateForm, 'level')->dropDownList(GroupHelper::getLevelList()) ?>

                <?= $form->field($updateForm, 'action')->dropDownList(GroupHelper::getActionList(), ['prompt' => 'Select ...']) ?>

                <?= $form->field($updateForm, 'type')->dropDownList(GroupHelper::getTypeList(), ['prompt' => 'Select ...']) ?>

                <?= $form->field($updateForm, 'price')->widget(MaskedInput::classname(), [
                    'clientOptions' => [
                        'alias' => 'decimal',
                        'groupSeparator' => ' ',
                        'autoGroup' => true,
                        'removeMaskOnSubmit' => true,
                        'rightAlign' => false
                    ],
                ]); ?>

                <?= $form->field($updateForm, 'period_start')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Enter event time ...'],
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ]
                ]); ?>

                <?= $form->field($updateForm, 'duration')->dropDownList(GroupHelper::getDurationList()) ?>

                <div class="container">
                    <div class="row ">
                        <div class="col-3 col-sm-4 col-md-5 col-lg-6">
                            <?= $form->field($updateForm, 'start_hour')->widget(TimePicker::classname(), []) ?>
                        </div>
                        <div class="col-3 col-sm-4 col-md-5 col-lg-6">
                            <?= $form->field($updateForm, 'end_hour')->widget(TimePicker::classname(), []) ?>
                        </div>
                    </div>
                </div>

                <?= $form->field($updateForm, 'group_days')->widget(Select2::class, [
                    'data' => GroupHelper::getDayList(),
                    'options' => ['placeholder' => 'Select group_days'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => true
                    ],
                ]); ?>

                <?= $form->field($updateForm, 'status')->dropDownList(GroupHelper::getStatusList()) ?>
            </div>

            <hr/>

            <?php echo $form->errorSummary($updateForm); ?>

            <div class="form-group text-center">
                <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-check"></span> ' .
                    Yii::t('ui', 'Save'),
                    [
                        'id' => 'save-' . $updateForm->formName(),
                        'class' => 'btn btn-success'
                    ]
                ); ?>
            </div>

        </section>

        <?php ActiveForm::end(); ?>

    </div>

</div>
