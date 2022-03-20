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
 * @var \backend\modules\catalog\forms\GroupCreateForm $createForm
 */

$this->title = Yii::t('models', 'Group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-create">

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?= Html::a(Yii::t('ui', 'Cansel'), ['index'],
                ['class' => 'btn btn-danger']) ?>
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
                <?= $form->field($createForm, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($createForm, 'subject_id')->widget(Select2::class, [
                    'data' => GroupHelper::getSubjectList(),
                    'options' => ['placeholder' => 'Select...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]); ?>

                <?= $form->field($createForm, 'teacher_id')->widget(Select2::class, [
                    'data' => GroupHelper::getTeacherList(),
                    'options' => ['placeholder' => 'Select...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]); ?>

                <?= $form->field($createForm, 'level')->dropDownList(GroupHelper::getLevelList()) ?>

                <?= $form->field($createForm, 'action')->dropDownList(GroupHelper::getActionList(), ['prompt' => 'Select ...']) ?>

                <?= $form->field($createForm, 'type')->dropDownList(GroupHelper::getTypeList(), ['prompt' => 'Select ...']) ?>

                <?= $form->field($createForm, 'price')->widget(MaskedInput::class, [
                    'clientOptions' => [
                        'alias' => 'decimal',
                        'groupSeparator' => ' ',
                        'autoGroup' => true,
                        'removeMaskOnSubmit' => true,
                        'rightAlign' => false
                    ],
                ]); ?>

                <?= $form->field($createForm, 'period_start')->widget(DatePicker::class, [
                    'options' => ['placeholder' => 'Select...'],
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ]
                ]); ?>
                <?= $form->field($createForm, 'duration')->dropDownList(GroupHelper::getDurationList()) ?>
                <div class="container">
                    <div class="row ">
                        <div class="col-3 col-sm-4 col-md-5 col-lg-6">
                            <?= $form->field($createForm, 'start_hour')->widget(TimePicker::class, []) ?>
                        </div>
                        <div class="col-3 col-sm-4 col-md-5 col-lg-6">
                            <?= $form->field($createForm, 'end_hour')->widget(TimePicker::class, []) ?>
                        </div>
                    </div>
                </div>
                <?= $form->field($createForm, 'group_days')->widget(Select2::class, [
                    'data' => GroupHelper::getDayList(),
                    'options' => ['placeholder' => 'Select...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => true
                    ],

                ]); ?>
                <?= $form->field($createForm, 'status')->dropDownList(GroupHelper::getStatusList()) ?>
            </div>

            <hr/>

            <?php echo $form->errorSummary($createForm); ?>

            <div class="text-center">
                <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-check"></span> ' .
                    Yii::t('ui', 'Create'),
                    [
                        'id' => 'save-' . $createForm->formName(),
                        'class' => 'btn btn-success'
                    ]
                ); ?>
            </div>

        </section>

        <?php ActiveForm::end(); ?>

    </div>

</div>
