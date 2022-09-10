<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysesOrders */

$this->title = Yii::t('lang', 'Order') . ' #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Analyses Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//\yii\web\YiiAsset::register($this);

?>
<div class="analyses-orders-view">

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
            [
                'attribute' => 'status',
//                'value' => $model->status ? '<span class="text-success">' . Yii::t('lang', 'Active') . '</span>' : '<span class="text-danger">' . Yii::t('lang', 'Inactive') . '</span>',
                'value' => function ($model) {
                        switch ($model->status) {
                        case 0:
                            return '<span class="text-primary">' . Yii::t('lang', 'New') . '</span>';
                            break;
                        case 1:
                            return '<span class="text-warning">' . Yii::t('lang', 'Edited') . '</span>';
                            break;
                        case 2:
                            return '<span class="text-success">' . Yii::t('lang', 'Done') . '</span>';
                            break;
                    }
                },
                'format' => 'html'
            ],
//            'doctor_id',
            [
                'attribute' => 'doctor_id',
                'value' => $model->doctor->name,
                'label' => 'Doctor name',
            ],
            [
                'attribute' => 'patient_id',
                'value' => $model->patient->name,
                'label' => 'Patient name',
            ],
//            'analyses_packages_nums',
            [
                'attribute' => 'analyses_packages_nums',
                'value' => $model->analyses_packages_nums . '(' . count(explode(',', $model->analyses_packages_nums)) . ')',
            ],
//            'date_biomaterial',
            [
                'attribute' => 'date_biomaterial',
                'format' => ['date', 'php:d.m.Y']
            ],
            'views',
            [
                'attribute' => 'analyses_values',
                'value' => $this->render('order_values', ['model' => $model, 'analyses' => $analyses]),
                'format' => 'raw'
            ],
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
