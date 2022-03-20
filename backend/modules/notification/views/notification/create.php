<?php

use common\helpers\NotificationHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var \backend\modules\catalog\forms\NotificationCreateForm $createForm
 */

$this->title = Yii::t('models', 'Notification');
?>
<div class="notification-create">

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?= Html::a('Cancel', ['index'],
                ['class' => 'btn btn-danger']) ?>
        </div>
    </div>

    <hr />

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
                <?= $form->field($createForm, 'title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($createForm, 'description')->textarea(['rows' => 2]) ?>

                <?= $form->field($createForm, 'group')->dropDownList(NotificationHelper::getGroupList(), ['prompt' => 'Select ...']) ?>

                <?= $form->field($createForm, 'status')->dropDownList(NotificationHelper::getStatusList()) ?>
            </div>

            <hr/>

            <?php echo $form->errorSummary($createForm); ?>

            <div class="text-center">
                <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-check"></span> ' .
                    Yii::t('ui','Create'),
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
