<?php

use common\helpers\PaymentHelper;
use common\models\Payment;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\search\PaymentSearch $searchModel
 */

$this->title = Yii::t('models', 'Payment-income');
$this->params['breadcrumbs'][] = $this->title;

if (isset($actionColumnTemplates)) {
    $actionColumnTemplate = implode(' ', $actionColumnTemplates);
    $actionColumnTemplateString = $actionColumnTemplate;
} else {
    Yii::$app->view->params['pageButtons'] = Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('ui', 'New'), ['create'], ['class' => 'btn btn-success']);
    $actionColumnTemplateString = "{view} {update} {delete}";
}
$actionColumnTemplateString = '<div class="action-buttons">' . $actionColumnTemplateString . '</div>';
?>
<div class="payment-income">

    <?php Pjax::begin(['id' => 'pjax-main', 'enableReplaceState' => false, 'linkSelector' => '#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>

    <hr/>

    <div>
        <?php
        $gridColumns = [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'width: 5%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'name',
                'vAlign' => 'middle',
                'hAlign' => 'left',
            ],
            [
                'attribute' => 'amount',
                'width' => '12%',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'pageSummary' => true,
                'value' => function (Payment $model) {
                    return ($model->type === Payment::TYPE_INCOME) ? $model->amount : -1 * $model->amount;
                },
                'format' => ['decimal'],
            ],
            [
                'width' => '12%',
                'attribute' => 'date',
                'vAlign' => 'middle',
                'hAlign' => 'center',
            ],
            [
                'width' => '10%',
                'attribute' => 'type',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'value' => function (Payment $model) {
                    return PaymentHelper::getTypeLabel($model->type);
                },

                'filter' => PaymentHelper::getTypeList(),
                'format' => 'raw'
            ],
            [
                'attribute' => 'status',
                'width' => '10%',
                'hAlign' => 'center',
                'value' => function (Payment $model) {
                    return PaymentHelper::getStatusLabel($model->status);
                },
                'filter' => PaymentHelper::getStatusList(),
                'format' => 'raw'
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'width' => '14%',
                'template' => $actionColumnTemplateString,
                'buttons' => [
                    'view' => function ($url, $model) {
                        $options = [
                            'title' => Yii::t('ui', "More information"),
                            'aria-label' => Yii::t('ui', "More information"),
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                    },
                    'update' => function ($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('ui', 'Edit'),
                            'aria-label' => Yii::t('ui', 'Edit'),
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $key], $options);
                    },
                    'delete' => function ($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('ui', 'Delete'),
                            'aria-label' => Yii::t('ui', 'Delete'),
                            'data-confirm' => Yii::t('ui', 'Are you sure that you want to delete this data?'),
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $key], $options);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url = Url::to(['view', 'id' => $key]);
                        return $url;
                    }
                },
            ],
        ];

        echo GridView::widget([
            'id' => 'kv-grid-confirmed_list',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
            'containerOptions' => ['style' => 'overflow: hidden'], // only set when $responsive = false
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'pjax' => true,
            'showPageSummary' => true,
            'pageSummaryRowOptions' => ['class' => 'kv-page-summary info'],
            'pageSummaryPosition' => GridView::POS_TOP,
            'toolbar' => [
                [
                    'content' =>
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
                            'class' => 'btn btn-default',
                            'title' => Yii::t('grid', 'Reset Grid'),
                            'data-pjax' => 0,
                        ]),
                    'options' => ['class' => 'btn-group mr-2']
                ],
            ],
            'export' => [
                'fontAwesome' => true
            ],
            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
            ],
            'persistResize' => false,
            'toggleDataOptions' => ['minCount' => 10],
        ]);
        ?>
    </div>
</div>

<?php Pjax::end() ?>
