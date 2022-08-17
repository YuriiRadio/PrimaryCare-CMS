<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysesPackages */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Analyses Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="analyses-packages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('lang', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('lang', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('lang', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'status',
            [
                'attribute' => 'status',
                'value' => $model->status ? '<span class="text-success">' . Yii::t('lang', 'Active') . '</span>' : '<span class="text-danger">' . Yii::t('lang', 'Inactive') . '</span>',
                'format' => 'html'
            ],
            [
                'attribute' => 'is_free',
                'value' => function ($model){
                    return $model->is_free ? Yii::t('lang', 'Yes') : Yii::t('lang', 'No');
                }
            ],
            'pac_num',
            'title',
            'analyses_ids',
            'cost:decimal',
            //'created_at',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y']
            ],
            //'updated_at',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d.m.Y']
            ],
        ],
    ]) ?>

</div>
