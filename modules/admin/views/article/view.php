<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

//$this->title = $model->id;
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

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
            //'category_id',
            [
                'attribute' => 'category_id',
                'value' => $model->articleCategory->name ? $model->articleCategory->name : Yii::t('lang', 'Independent category'),
            ],
            'title',
            'body:html',
            'keywords',
            'description',
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
            'views',
        ],
    ]) ?>

</div>
