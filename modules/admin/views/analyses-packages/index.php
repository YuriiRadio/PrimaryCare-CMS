<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AnalysesPackagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lang', 'Analyses Packages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analyses-packages-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('lang', 'Create Analyses Packages'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
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
//            'is_free',
            [
                'attribute' => 'is_free',
                'filter' => [1 => Yii::t('lang', 'Yes'), 0 => Yii::t('lang', 'No')],
                'value' => function ($model){
                    return $model->is_free ? Yii::t('lang', 'Yes') : Yii::t('lang', 'No');
                }
            ],
            'pac_num',
            'title',
            //'analyses_ids',
            'cost:decimal',
            // 'created_at',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y']
            ],
            // 'updated_at',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d.m.Y']
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
