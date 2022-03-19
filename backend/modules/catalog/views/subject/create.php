<?php

use common\helpers\SubjectHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\MaskedInput;

/**
 * @var yii\web\View $this
 * @var common\models\Subject $model
 * @var \backend\modules\catalog\forms\SubjectCreateForm $createForm
 */
$this->title = Yii::t('models', 'Subject');
?>
<div class="subject-create">

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?= Html::a(Yii::t('ui', 'Cansel'), ['index'], ['class' => 'btn btn-danger']) ?>
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
                <?= $form->field($createForm, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($createForm, 'price')->widget(MaskedInput::class, [
                    'clientOptions' => [
                        'alias' => 'decimal',
                        'groupSeparator' => ' ',
                        'autoGroup' => true,
                        'removeMaskOnSubmit' => true,
                        'rightAlign' => false
                    ],
                ]);  ?>

                <?= $form->field($createForm, 'status')->dropDownList(SubjectHelper::getStatusList()) ?>
            </div>

            <hr/>

            <?php echo $form->errorSummary($createForm); ?>

            <div class="form-group  text-center">
                <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-check"></span> ' .
                    Yii::t('ui', "Create"),
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
