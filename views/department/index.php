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

    <?= GridView::widget([
        'pager' => [
            'class' => 'yii\bootstrap4\LinkPager'
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'name',
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['department/view', 'id' => $model->id]);
                },
                'format' => 'html'
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
            'street',
            'building',
            'phone',
        ],
    ]); ?>
</div>


