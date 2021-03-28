<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\StaticPage */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Static Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="static-page-view">

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
            'alias',
            'title',
            'body:html',
            'position',
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
