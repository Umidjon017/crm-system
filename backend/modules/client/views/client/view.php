<?php

use common\helpers\ClientHelper;
use common\models\Client;
use dmstr\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Client $model
 */
$copyParams = $model->attributes;

$this->title = Yii::t('models', 'Client'). ': ' .$model->full_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="client-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>
            <?= Html::a(
                '<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('ui', 'Edit'),
                ['update', 'id' => $model->id],
                ['class' => 'btn btn-info']) ?>

            <?= Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('ui', "New"),
                ['create'],
                ['class' => 'btn btn-success']) ?>
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> '
                . Yii::t('ui', "Full list"), ['index'], ['class' => 'btn btn-warning']) ?>
        </div>

    </div>

    <hr/>

    <?php $this->beginBlock('common\models\Client'); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'groupList',
                'value' => function (Client $model) {
                    return $model->getGroupsText();
                },
            ],
            'full_name',
            [
                'attribute' => 'gender',
                'value' => function (Client $model) {
                    return ClientHelper::getGenderName($model->gender);
                },
            ],
            'visited_date',
            [
                'attribute'=>'Phones',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'250px',
                'value' => function (Client $model) {
                    return $model->getPhoneText();
                },
            ],
            [
                'attribute'=>'Phone Type',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'width'=>'250px',
                'value' => function (Client $model) {
                    return $model->getPhoneTypeText();
                }
            ],
            'comment',
            [
                'attribute' => 'status',
                'value' => function (Client $model) {
                    return ClientHelper::getStatusLabel($model->status);
                },
                'format' => 'raw'
            ],
        ],
    ]); ?>

    <hr/>

    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('ui','Delete'), ['delete', 'id' => $model->id],
        [
            'class' => 'btn btn-danger',
            'data-confirm' => '' . 'Are you sure to delete this item?' . '',
            'data-method' => 'post',
        ]); ?>
    <?php $this->endBlock(); ?>

    <?= Tabs::widget([
        'id' => 'relation-tabs',
        'encodeLabels' => false,
        'items' => [
            [
                'label'   => '<b class=""><i class="fa fa-info-circle"></i> '.Yii::t('ui','More information').'</b>',
                'content' => $this->blocks['common\models\Client'],
                'active'  => true,
            ],
        ]
    ]);
    ?>
</div>
