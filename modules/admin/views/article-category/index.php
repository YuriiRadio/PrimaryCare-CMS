<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lang', 'Article Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('lang', 'Create Article Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'status',
                'filter'=> [1 => Yii::t('lang', 'Active'), 0 => Yii::t('lang', 'Inactive')],
                'value' => function ($model) {
                    return $model->status ? '<span class="text-success">'.Yii::t('lang', 'Active').'</span>' : '<span class="text-danger">'.Yii::t('lang', 'Inactive').'</span>';
                },
                'format' => 'html',
            ],
            'alias',
            //'parent_id',
            [
                'attribute' => 'parent_id',
                'value' => function ($model) {
                    return @$model->parentCategory->name ? @$model->parentCategory->name : Yii::t('lang', 'Independent category');
                },
                'filter' => \app\models\ArticleCategory::getParentsList()
            ],
            'name',
            //'created_at',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y']
            ],
            //'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
