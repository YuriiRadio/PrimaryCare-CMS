<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

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
            'username',
            //'password_hash',
            //'auth_key',
            //'password_reset_token',
            'email:email',
            //'status',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status ? '<span class="text-success">'.Yii::t('lang', 'Active').'</span>' : '<span class="text-danger">'.Yii::t('lang', 'Inactive').'</span>';
                },
                'format' => 'html',
            ],
            //'role',
            [
                'attribute' => 'role',
                'value' => function ($model) {
                    if ($model->role == 1) {
                        return '<span class="text-danger">'.Yii::t('lang', 'Admin').'</span>';
                    } elseif ($model->role == 2) {
                        return '<span class="text-success">'.Yii::t('lang', 'User').'</span>';
                    }
                },
                'format' => 'html',
            ],
            //'created_at',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y']
            ],
            //'updated_at:datetime',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d.m.Y']
            ],
        ],
    ]) ?>

</div>
