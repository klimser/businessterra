<?php

use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \common\models\OrderSearch */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-sm table-responsive'],
        'pager' => ['class' => LinkPager::class, 'listOptions' => ['class' => 'pagination justify-content-center']],
        'rowOptions' => function ($model, $index, $widget, $grid) {
            switch ($model->status) {
                case \common\models\Order::STATUS_DONE:
                    $class = 'table-success';
                    break;
                case \common\models\Order::STATUS_PROBLEM:
                    $class = 'table-danger';
                    break;
                case \common\models\Order::STATUS_PAID:
                    $class = 'table-primary';
                    break;
                case \common\models\Order::STATUS_UNPAID:
                    $class = 'table-secondary';
                    break;
            }
            $return = ['title' => $model->admin_comment];
            if (isset($class)) {
                $return['class'] = $class;
            }
            return $return;
        },
        'columns' => [
            'subject',
            [
                'attribute' => 'name',
                'header' => 'Имя',
            ],
            [
                'attribute' => 'phone',
                'header' => 'Телефон',
                'content' => function ($model, $key, $index, $column) { return "<nobr>{$model->phoneFull}</nobr>"; },
            ],
            [
                'attribute' => 'user_comment',
                'header' => 'Комментарии',
                'content' => function ($model, $key, $index, $column) {
                    $content = ($model->type ? "Билет - $model->type<br>" : '')
                        . ($model->price ? "Цена - $model->price<br>" : '')
                        . $model->user_comment;
                    if ($model->admin_comment) {
                        $content .= '<br><i>Комментарий админа:</i> ' . $model->admin_comment;
                    }
                    return $content ?: '<span class="not-set">(не задано)</span>';
                },
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'createDateString',
                    'template' => '{addon}{input}',
                    'clientOptions' => [
                        'weekStart' => 1,
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ],
                ]),
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'content' => function ($model, $key, $index, $column) {
                    switch ($model->status) {
                        case \common\models\Order::STATUS_PAID:
                            return Html::tag('span', \common\models\Order::$statusLabels[$model->status], ['class' => 'badge badge-primary']);
                            break;
                        case \common\models\Order::STATUS_UNPAID:
                            return Html::tag('span', \common\models\Order::$statusLabels[$model->status], ['class' => 'badge badge-secondary']);
                            break;
                        default:
                            return Html::activeDropDownList($model, 'status', \common\models\Order::$statusLabels, ['class' => 'form-control input-sm', 'onchange' => 'Main.changeEntityStatus("order", ' . $model->id . ', $(this).val(), this);', 'id' => 'order-status-' . $key]);
                    }
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    array_merge(['' => 'Любой'], \common\models\Order::$statusLabels),
                    ['class' => 'form-control']
                ),
            ],
            [
                'class' => \yii\grid\ActionColumn::class,
                'template' => '<nobr>{update}{delete}</nobr>',
                'buttonOptions' => ['class' => 'btn btn-default margin-right-10'],
            ],
        ],
    ]); ?>

</div>
