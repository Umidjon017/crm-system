<?php

use common\helpers\ClientHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\widgets\MaskedInput;

/**
 * @var yii\web\View $this
 * @var backend\modules\client\forms\ClientCreateForm $modelsClient
 * @var common\models\ClientPhone $modelsPhone
 */

$this->title = Yii::t('models', 'Client');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class=" client-create">

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?= Html::a(Yii::t('ui', 'Cancel'), ['index'], ['class' => 'btn btn-danger']) ?>
        </div>
    </div>

    <hr/>

    <div class="client-form">

        <?php $form = ActiveForm::begin([
            'id' => 'dynamic-form',
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
                <?= $form->field($modelsClient, 'group_list')->widget(Select2::class, [
                    'data' => ClientHelper::getGroupList(),
                    'options' => ['placeholder' => 'Select subjects ...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => true
                    ],
                ]); ?>

                <hr/>

                <?= $form->field($modelsClient, 'full_name')->textInput(['maxlength' => true]) ?>

                <div class="row" style="width: 66%; margin-left: 17%">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h4><i></i> phone</h4></div>
                        <div class="panel-body">
                            <?php DynamicFormWidget::begin([
                                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                'widgetBody' => '.container-items', // required: css class selector
                                'widgetItem' => '.item', // required: css class
                                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                                'min' => 1, // 0 or 1 (default 1)
                                'insertButton' => '.add-item', // css class
                                'deleteButton' => '.remove-item', // css class
                                'model' => $modelsPhone[0],
                                'formId' => 'dynamic-form',
                                'formFields' => [
                                    'full_name',
                                    'phone',
                                ],
                            ]); ?>
                            <div class="container-items"><!-- widgetContainer -->
                                <?php
                                $count = 0;
                                foreach ($modelsPhone as $i => $modelPhone): ?>
                                    <div class="item panel panel-default"><!-- widgetBody -->
                                        <div class="panel-heading">
                                            <h3 class="panel-title pull-left">phone</h3>
                                            <div class="pull-right">
                                                <button type="button" class="add-item btn btn-success btn-xs"><i
                                                            class="glyphicon glyphicon-plus"></i></button>
                                                <button type="button" onclick=""
                                                        class="remove-item btn btn-danger btn-xs"><i
                                                            class="glyphicon glyphicon-minus"></i></button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="panel-body">
                                            <!--                                            --><?php
                                            //                                            // necessary for update action.
                                            //                                            if (!$modelPhone->isNewRecord) {
                                            //                                                echo Html::activeHiddenInput($modelPhone, "[{$i}]id");
                                            //                                            }
                                            //                                            ?>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <?= $form->field($modelPhone, "[{$i}]phone")->widget(MaskedInput::className(),[
                                                        'mask' => '(99) 999-9999'
                                                    ]) ?>

                                                </div>
                                                <div class="col-sm-6">
                                                    <?= $form->field($modelPhone, "[{$i}]type")->dropDownList(ClientHelper::getPhoneTypeList()) ?>

                                                </div>
                                            </div><!-- .row -->

                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php DynamicFormWidget::end(); ?>
                        </div>
                    </div>
                    <!-- attribute status -->
                </div>
                <!-- attribute number_of_students -->
                <?= $form->field($modelsClient, 'gender')->dropDownList(ClientHelper::getGenderList(), [
                    'prompt' => Yii::t('ui', 'Select')
                ]) ?>

                <!-- attribute visited_date -->
                <?= $form->field($modelsClient, 'visited_date')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Enter event time ...'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd/mm/yyyy',
                        'todayHighlight' => true
                    ]
                ]) ?>

                <!-- attribute commit -->
                <?= $form->field($modelsClient, 'comment')->textarea(['rows' => 2]) ?>

                <?= $form->field($modelsClient, 'status')->dropDownList(ClientHelper::getStatusList()) ?>
            </div>

            <hr/>

            <div class="text-center">
                <?php echo $form->errorSummary($modelsClient); ?>

                <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-check"></span> ' .
                    'Create',
                    [
                        'id' => 'save-' . $modelPhone->formName(),
                        'class' => 'btn btn-success'
                    ]);
                ?>

                <?php ActiveForm::end(); ?>

            </div>
        </section>
    </div>
</div>
