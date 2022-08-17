<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnalysesCategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lang', 'Analyses Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analyses-categories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('lang', 'Create Analyses Categories'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            //'status',
            [
                'attribute' => 'status',
                'filter' => [1 => Yii::t('lang', 'Active'), 0 => Yii::t('lang', 'Inactive')],
                'value' => function ($model) {
                    return $model->status ? '<span class="text-success">' . Yii::t('lang', 'Active') . '</span>' : '<span class="text-danger">' . Yii::t('lang', 'Inactive') . '</span>';
                },
                'format' => 'html',
            ],
            'title',
            // 'created_at',
            [
                'attribute' => 'created_at',
                'filter' => kartik\date\DatePicker::widget([
                    'name' => 'dp_1',
//                    'type' => kartik\date\DatePicker::TYPE_INPUT,
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd.mm.yyyy',
                        'todayHighlight' => true
                    ]
                ]),
                'format' => ['date', 'php:d.m.Y']
            ],
            // 'updated_at',
            [
                'attribute' => 'updated_at',
                'filter' => kartik\date\DatePicker::widget([
                    'name' => 'dp_2',
//                    'type' => kartik\date\DatePicker::TYPE_INPUT,
                    'model' => $searchModel,
                    'attribute' => 'updated_at',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd.mm.yyyy',
                        'todayHighlight' => true
                    ]
                ]),
                'format' => ['date', 'php:d.m.Y']
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
