<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lang', 'Regions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('lang', 'Create Region'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'pager' => [
            'class' => 'yii\bootstrap4\LinkPager'
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'alias',
            //'parent_id',
            [
                'attribute' => 'parent_id',
                'value' => function ($model) {
                    return @$model->parentCategory->name ? @$model->parentCategory->name : Yii::t('lang', 'Independent region');
                },
                'filter' => \app\models\Region::getParentsList()
            ],
            'name',
            //'created_at',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y']
            ],
            //'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' =>  function($url,$model) {
                        return Html::a('<i class="bi bi-pencil"></i>', $url, [
                            'title' => Yii::t('lang', 'Update')
                        ]);
                    },
                    'view' =>  function($url,$model) {
                        return Html::a('<i class="bi bi-eye"></i>', $url, [
                            'title' => Yii::t('lang', 'View')
                        ]);
                    },
//                  'delete' => function($url,$model) {
//                      return Html::a('<i class="bi bi-trash"></i>', $url, [
//                           'title' => Yii::t('lang', 'delete')
//                      ]);
//                    }
                    'delete' => function($url,$model) {
                        return Html::a('<i class="bi bi-trash"></i>', $url, [
                            'title' => Yii::t('lang', 'Delete'),
//                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('lang', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]);
                    }
                 ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
