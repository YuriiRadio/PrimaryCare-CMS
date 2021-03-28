<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DoctorCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Doctor Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-category-view">

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
            'name',
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
