<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnalysesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lang', 'Analyses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analyses-types-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a(Yii::t('lang', 'Create Analyses'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'pager' => [
            'class' => 'yii\bootstrap4\LinkPager'
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn', 'name' => 'id'],
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
            'pac_num',
//            'is_free',
            [
                'attribute' => 'is_free',
                'filter' => [1 => Yii::t('lang', 'Yes'), 0 => Yii::t('lang', 'No')],
                'value' => function ($model){
                    return $model->is_free ? Yii::t('lang', 'Yes') : Yii::t('lang', 'No');
                }
            ],
            // 'analys_content:ntext',
            'units',
            'cost:decimal',
             'device',
            //'department_id',
            // 'created_at',
//            [
//                'attribute' => 'created_at',
//                'format' => ['date', 'php:d.m.Y']
//            ],
            // 'updated_at',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d.m.Y']
            ],
            ['class' => 'yii\grid\ActionColumn',
//                'buttons' => [
//                    'update' => function($url) {
//                        return Html::a('<i class="bi bi-pencil"></i>', $url, [
//                                    'title' => Yii::t('lang', 'Update')
//                        ]);
//                    },
//                    'view' => function($url) {
//                        return Html::a('<i class="bi bi-eye"></i>', $url, [
//                                    'title' => Yii::t('lang', 'View')
//                        ]);
//                    },
//                    'delete' => function($url) {
//                        return Html::a('<i class="bi bi-trash"></i>', $url, [
//                                    'title' => Yii::t('lang', 'Delete'),
//                                    //                                    'class' => 'btn btn-danger',
//                                    'data' => [
//                                        'confirm' => Yii::t('lang', 'Are you sure you want to delete this item?'),
//                                        'method' => 'post',
//                                    ],
//                        ]);
//                    }
//                ]
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
