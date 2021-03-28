<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lang', 'Departments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('lang', 'Create Department'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'alias',
            //'status',
            [
                'attribute' => 'status',
                'filter'=> [1 => Yii::t('lang', 'Active'), 0 => Yii::t('lang', 'Inactive')],
                'value' => function ($model) {
                    return $model->status ? '<span class="text-success">'.Yii::t('lang', 'Active').'</span>' : '<span class="text-danger">'.Yii::t('lang', 'Inactive').'</span>';
                },
                'format' => 'html',
            ],
            //'parent_id',
            [
                'attribute' => 'parent_id',
                'value' => function ($model) {
                    return @$model->parent->name ? @$model->parent->name : Yii::t('lang', 'Parent');
                },
                'filter' => \app\models\Department::getParentsList()
            ],
            //'region_id',
            [
                'attribute' => 'region_id',
                'value' => function ($model) {
                    return $model->region->name;
                },
                'filter' => \app\models\RegionI18n::find()
                            ->select(['name', 'parent_table_id'])
                            ->where(['language' => Yii::$app->language])
                            ->indexBy('parent_table_id')
                            ->column()
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
