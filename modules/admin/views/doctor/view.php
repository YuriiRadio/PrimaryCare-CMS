<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Doctor */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Doctors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-view">

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
                'value' => $model->status ? '<span class="text-success">'.Yii::t('lang', 'Active').'</span>' : '<span class="text-danger">'.Yii::t('lang', 'Inactive').'</span>',
                'format' => 'html'
            ],
            'name',
            //'doctor_specialty_id',
            [
                'attribute' => 'doctor_specialization_id',
                'value' => $model->specialization->name,
            ],
            //'doctor_category_id',
            [
                'attribute' => 'doctor_category_id',
                'value' => $model->category->name,
            ],
            //'department_id',
            [
                'attribute' => 'department_id',
                'value' => $model->department->name,
            ],
            'experience',
            'email:email',
            'phone',
            'body:html',
            'schedule',
            'number_patients',
            'allowed_number_patients',
            'views',
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
