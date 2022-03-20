<?php
use common\helpers\PaymentHelper;

use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\MaskedInput;

/**
 * @var yii\web\View $this
 * @var common\models\Payment $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="payment-form">

    <?php $form = ActiveForm::begin([
            'id' => 'Payment',
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
        ]);
    ?>

    <section>
        <div>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'amount')->widget(MaskedInput::classname(), [
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ' ',
                    'autoGroup' => true,
                    'removeMaskOnSubmit' => true,
                    'rightAlign' => false
                ],
            ]); ?>

            <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Enter the date ...'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy--mm-dd'
                ]
            ]); ?>

            <?= $form->field($model, 'type')->dropDownList(PaymentHelper::getTypeList(), ['prompt' => 'Choose type...']) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>

            <?= $form->field($model, 'status')->dropDownList(PaymentHelper::getStatusList()) ?>
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
                ]);
            ?>
        </div>
        <?php ActiveForm::end(); ?>
    </section>
</div>
