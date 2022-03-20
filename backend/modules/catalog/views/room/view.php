<?php

use common\helpers\RoomHelper;
use common\models\Room;
use dmstr\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Room $model
 */
$copyParams = $model->attributes;

$this->title = Yii::t('models', 'Room'). ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="room-view">

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
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('ui', "Add"),
                ['create'],
                ['class' => 'btn btn-success']) ?>
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> '
                . Yii::t('ui', "Full list"), ['index'], ['class' => 'btn btn-warning']) ?>
        </div>

    </div>

    <hr/>

    <?php $this->beginBlock('common\models\Room'); ?>

    <?= DetailView::widget([
        'template' => "<tr><th style='width: 20%'>{label}</th><td>{value}</td></tr>",
        'model' => $model,
        'attributes' => [
            'name',
            'number_of_students',
            [
                'attribute' => 'type',
                'value' => function (Room $model) {
                    return RoomHelper::getTypeLabel($model->type);
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'status',
                'value' => function (Room $model) {
                    return RoomHelper::getStatusLabel($model->status);
                },
                'format' => 'raw'
            ]
        ],
    ]); ?>


    <hr/>

    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('ui', 'Delete'), ['delete', 'id' => $model->id],
        [
            'class' => 'btn btn-danger',
            'data-confirm' => '' . 'Are you sure to delete this item?' . '',
            'data-method' => 'post',
        ]); ?>
    <?php $this->endBlock(); ?>

    <?= Tabs::widget(
        [
            'id' => 'relation-tabs',
            'encodeLabels' => false,
            'items' => [
                [
                    'label' => '<b> <i class="fa fa-info-circle"></i> ' . Yii::t('ui', "More information") . '</b>',
                    'content' => $this->blocks['common\models\Room'],
                    'active'  => true,
                ],
            ]
        ]
    ); ?>
</div>
