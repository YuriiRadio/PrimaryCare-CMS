<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Patients */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Patients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="patients-view">

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
//            'doctor_id',
            'doctor.name',
            [
                'attribute' => 'our_patient',
                'value' => $model->our_patient ? '<span class="text-success">' . Yii::t('lang', 'Yes') . '</span>' : '<span class="text-info">' . Yii::t('lang', 'No') . '</span>',
                'format' => 'html',
            ],
            'declaration_number',
            'name',
            'birth',
//            'sex',
            [
                'attribute' => 'sex',
                'value' => function ($model) {
                    switch ($model->sex) {
                        case 1:
                            return Yii::t('lang', 'Male');
                            break;
                        case 0:
                            return Yii::t('lang', 'Female');
                            break;
                        case 2:
                            return Yii::t('lang', 'It');
                            break;
                    }
                },
            ],
            'address',
            'email:email',
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
