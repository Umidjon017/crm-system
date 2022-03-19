<?php

use common\helpers\SubjectHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\MaskedInput;

/**
 * @var yii\web\View $this
 * @var common\models\Subject $model
 * @var backend\modules\catalog\forms\SubjectUpdateForm $updateForm
 */

$this->title = Yii::t('models', 'Subject');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Subject'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class=" subject-update">

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-file"></span> ' . Yii::t('ui', "More information"), ['view', 'id' => $model->id], ['class' => 'btn btn-info']) ?>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> '
                . Yii::t('ui', "Full list"), ['index'], ['class' => 'btn btn-warning']) ?>
        </div>
    </div>

    <hr/>

    <div class="subject-form">

        <?php $form = ActiveForm::begin([
            'id' => 'Subject',
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

                <?= $form->field($updateForm, 'price')->widget(MaskedInput::class, [
                    'clientOptions' => [
                        'alias' => 'decimal',
                        'groupSeparator' => ' ',
                        'autoGroup' => true,
                        'removeMaskOnSubmit' => true,
                        'rightAlign' => false
                    ],
                ]);  ?>

                <?= $form->field($updateForm, 'status')->dropDownList(SubjectHelper::getStatusList()) ?>
            </div>

            <hr/>

            <?php echo $form->errorSummary($updateForm); ?>

            <div class="form-group  text-center">
                <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-check"></span> ' .
                    Yii::t('ui', "Save"),
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
