<?php

use common\helpers\TeacherHelper;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var \backend\modules\catalog\forms\TeacherCreateForm $createForm
 */

$this->title = Yii::t('models', 'Teacher');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Teachers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-create">

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?= Html::a(Yii::t('ui', 'Cansel'), ['index'], ['class' => 'btn btn-danger']) ?>
        </div>
    </div>

    <hr/>

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
                <?= $form->field($createForm, 'full_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($createForm, 'gender')->dropDownList(TeacherHelper::getGenderList(), ['prompt' => Yii::t('ui', 'Choose...')]) ?>

                <?= $form->field($createForm, 'birth_date')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Enter birth date ...'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'format' => 'dd-mm-yyyy'
                    ]
                ]); ?>

                <?= $form->field($createForm, 'phone')->textInput(['maxlength' => true]) ?>

                <?= $form->field($createForm, 'photoFile')->widget(FileInput::classname(), [ 'attribute' => 'photo',
                    'pluginOptions' => [
                        'accept' => "image/png , image/jpeg",
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' =>true
                    ]
                ])  ?>

                <?= $form->field($createForm, 'address')->textInput(['maxlength' => true]) ?>

                <?= $form->field($createForm, 'status')->dropDownList(TeacherHelper::getStatusList()) ?>

                <?= $form->field($createForm, 'subject_list')->widget(Select2::class, [
                    'data' => TeacherHelper::getSubjectList(),
                    'options' => ['placeholder' => 'Select subjects ...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => true
                    ],
                ]); ?>
            </div>

            <hr/>

            <?php echo $form->errorSummary($createForm); ?>
            <div class="text-center">
                <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-check"></span> ' .
                    'Create',
                    [
                        'id' => 'save-' . $createForm->formName(),
                        'class' => 'btn btn-success'
                    ]
                ); ?>
            </div>
            <?php ActiveForm::end(); ?>

        </section>

    </div>

</div>
