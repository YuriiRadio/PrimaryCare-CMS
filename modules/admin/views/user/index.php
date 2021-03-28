<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lang', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('lang', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            //'password_hash',
            //'auth_key',
            //'password_reset_token',
            'email:email',
            //'status',
            [
                'attribute' => 'status',
                'filter'=> [1 => Yii::t('lang', 'Active'), 0 => Yii::t('lang', 'Inactive')],
                'value' => function ($model) {
                    return $model->status ? '<span class="text-success">'.Yii::t('lang', 'Active').'</span>' : '<span class="text-danger">'.Yii::t('lang', 'Inactive').'</span>';
                },
                'format' => 'html',
            ],
            //'role',
            [
                'attribute' => 'role',
                'filter'=> [1 => Yii::t('lang', 'Admin'), 2 => Yii::t('lang', 'User')],
                'value' => function ($model) {
                    if ($model->role == 1) {
                        return '<span class="text-danger">'.Yii::t('lang', 'Admin').'</span>';
                    } elseif ($model->role == 2) {
                        return '<span class="text-success">'.Yii::t('lang', 'User').'</span>';
                    }
                },
                'format' => 'html',
            ],
            'last_ip',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
