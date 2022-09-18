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
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'pager' => [
            'class' => 'yii\bootstrap4\LinkPager'
        ],
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
                'filter'=> [
                        \app\models\User::ROLE_ADMIN => Yii::t('lang', 'Admin'),
                        \app\models\User::ROLE_USER => Yii::t('lang', 'User'),
                        \app\models\User::ROLE_DOCTOR => Yii::t('lang', 'Doctor'),
                        \app\models\User::ROLE_LABORANT => Yii::t('lang', 'Laborant')
                    ],
                'value' => function ($model) {
                    if ($model->role == $model::ROLE_ADMIN) {
                        return '<span class="text-danger">'.Yii::t('lang', 'Admin').'</span>';
                    } elseif ($model->role == $model::ROLE_USER) {
                        return '<span class="text-dark">'.Yii::t('lang', 'User').'</span>';
                    } elseif ($model->role == $model::ROLE_DOCTOR) {
                        return '<span class="text-success">'.Yii::t('lang', 'Doctor').'</span>';
                    } elseif ($model->role == $model::ROLE_LABORANT) {
                        return '<span class="text-info">'.Yii::t('lang', 'Laborant').'</span>';
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

            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' =>  function($url,$model) {
                        return Html::a('<i class="bi bi-pencil"></i>', $url, [
                            'title' => Yii::t('lang', 'Update')
                        ]);
                    },
                    'view' =>  function($url,$model) {
                        return Html::a('<i class="bi bi-eye"></i>', $url, [
                            'title' => Yii::t('lang', 'View')
                        ]);
                    },
//                  'delete' => function($url,$model) {
//                      return Html::a('<i class="bi bi-trash"></i>', $url, [
//                           'title' => Yii::t('lang', 'delete')
//                      ]);
//                    }
                    'delete' => function($url,$model) {
                        return Html::a('<i class="bi bi-trash"></i>', $url, [
                            'title' => Yii::t('lang', 'Delete'),
//                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('lang', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]);
                    }
                 ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
<?php Pjax::end(); ?>
</div>
