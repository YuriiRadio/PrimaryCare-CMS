<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Region */

//$this->title = $model->id;
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Departments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-view">

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
            'alias',
            //'parent_id',
            [
                'attribute' => 'parent_id',
                'value' => @$model->parent->name ? @$model->parent->name : Yii::t('lang', 'Parent'),
            ],
            'name',
            //'region_id',
            [
                'attribute' => 'region_id',
                'value' => @$model->region->name,
            ],
            'phone',
            'email',
            'street',
            'building',
            'zip_code',
            'body:html',
            'latitude',
            'longitude',
            //'created_at',
            [
                'attribute' => 'created_at',
                'value' =>  date('d.m.Y', $model->created_at),
            ],
            //'updated_at',
            [
                'attribute' => 'updated_at',
                'value' =>  date('d.m.Y', $model->updated_at),
            ],
        ],
    ]) ?>

</div>
