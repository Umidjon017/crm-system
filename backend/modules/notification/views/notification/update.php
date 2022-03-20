<?php

use common\helpers\NotificationHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Notification $model
 * @var \backend\modules\catalog\forms\NotificationUpdateForm $updateForm
 */

$this->title = Yii::t('models', 'Notification');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Notification'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="notification-update">

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-file"></span> ' . Yii::t('ui', 'View'), ['view', 'id' => $model->id], ['class' => 'btn btn-info']) ?>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> ' . Yii::t('ui', 'Full list'), ['index'], ['class' => 'btn btn-warning']) ?>
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
                <?= $form->field($updateForm, 'title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($updateForm, 'description')->textarea(['rows' => 2]) ?>

                <?= $form->field($updateForm, 'group')->dropDownList(NotificationHelper::getGroupList(), ['prompt' => 'Select ...']) ?>

                <?= $form->field($updateForm, 'status')->dropDownList(NotificationHelper::getStatusList()) ?>
            </div>

            <hr/>

            <?php echo $form->errorSummary($updateForm); ?>

            <div class="text-center">
                <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-check"></span> ' .
                    Yii::t('ui','Save'),
                    [
                        'id' => 'save-' . $updateForm->formName(),
                        'class' => 'btn btn-success'
                    ]
                ); ?>
            </div>

            <?php ActiveForm::end(); ?>

        </section>
    </div>
</div>
