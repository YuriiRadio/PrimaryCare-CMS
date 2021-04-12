<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lang', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('lang', 'Create Article'), ['create'], ['class' => 'btn btn-success']) ?>
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

            'id',
            //'status',
            [
                'attribute' => 'status',
                'filter'=> [1 => Yii::t('lang', 'Active'), 0 => Yii::t('lang', 'Inactive')],
                'value' => function ($model) {
                    return $model->status ? '<span class="text-success">'.Yii::t('lang', 'Active').'</span>' : '<span class="text-danger">'.Yii::t('lang', 'Inactive').'</span>';
                },
                'format' => 'html',
            ],
            'alias',
            //'category_id',
            [
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return $model->articleCategory->name;
                },
            ],
            'title',
            //'created_at',
            //'updated_at',
            'views',

            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' =>  function($url,$model) {
                        return Html::a('<i class="bi bi-pencil"></i>', $url, [
                            'title' => Yii::t('app', 'update')
                        ]);
                    },
                    'view' =>  function($url,$model) {
                        return Html::a('<i class="bi bi-eye"></i>', $url, [
                            'title' => Yii::t('app', 'view')
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
