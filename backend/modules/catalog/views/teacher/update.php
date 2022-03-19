<?php

use common\helpers\TeacherHelper;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Teacher $teacherModel
 * @var backend\modules\catalog\forms\TeacherUpdateForm $updateForm
 */

$this->title = Yii::t('models', 'Teacher');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Teacher'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="teacher-update">

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-file"></span> ' . Yii::t('ui', "More information"), ['view', 'id' => $teacherModel->id], ['class' => 'btn btn-info']) ?>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> '
                . Yii::t('ui', "Full list"), ['index'], ['class' => 'btn btn-warning']) ?>
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
        );?>
        <section>
            <div>
                <?= $form->field($updateForm, 'full_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($updateForm, 'gender')->dropDownList(TeacherHelper::getGenderList(), ['prompt' => Yii::t('ui', 'Choose...')]) ?>

                <?= $form->field($updateForm, 'birth_date')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Enter birth date ...'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'format' => 'dd-mm-yyyy'
                    ]
                ]); ?>

                <?= $form->field($updateForm, 'phone')->textInput(['maxlength' => true]) ?>

                <?= $form->field($updateForm, 'address')->textInput(['maxlength' => true]) ?>

                <?= $form->field($updateForm, 'status')->dropDownList(TeacherHelper::getStatusList()) ?>

                <?= $form->field($updateForm, 'subject_list')->widget(Select2::class, [
                    'data' => TeacherHelper::getSubjectList(),
                    'options' => ['placeholder' => 'Select subjects ...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => true
                    ],
                ]); ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="text-center">
                            <?= Html::img($teacherModel->getPhotoSrc(), ['style' => 'max-width: 300px;']) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($updateForm, 'photo_file')->widget(FileInput::classname(), [ 'attribute' => 'photo',
                            'pluginOptions' => [
                                'accept' => "image/png , image/jpeg",
                                'showPreview' => false,
                                'showCaption' => true,
                                'showRemove' => true,
                                'showUpload' =>true
                            ]
                        ])  ?>
                    </div>
                </div>
            </div>

            <hr/>

            <?php echo $form->errorSummary($updateForm); ?>
            <div class="text-center">
                <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-check"></span> ' .
                    Yii::t('ui', 'Save'),
                    [
                        'id' => 'save-' . $updateForm->formName(),
                        'class' => 'btn btn-success'
                    ]
                );
                ?>
            </div>
            <?php ActiveForm::end(); ?>

        </section>

    </div>

</div>
