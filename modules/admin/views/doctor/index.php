<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DoctorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lang', 'Doctors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('lang', 'Create Doctor'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'status',
            [
                'attribute' => 'status',
                'filter'=> [1 => Yii::t('lang', 'Active'), 0 => Yii::t('lang', 'Inactive')],
                'value' => function ($model) {
                    return $model->status ? '<span class="text-success">'.Yii::t('lang', 'Active').'</span>' : '<span class="text-danger">'.Yii::t('lang', 'Inactive').'</span>';
                },
                'format' => 'html',
            ],
            'name',
            //'doctor_specialty_id',
            [
                'attribute' => 'doctor_specialization_id',
                'value' => function ($model) {
                    return $model->specialization->name;
                },
                'filter' => \app\models\DoctorSpecializationI18n::find()
                            ->select(['name', 'parent_table_id'])
                            ->where(['language' => Yii::$app->language])
                            ->indexBy('parent_table_id')
                            ->column()
            ],
            //'doctor_category_id',
            [
                'attribute' => 'doctor_category_id',
                'value' => function ($model) {
                    return $model->category->name;
                },
                'filter' => \app\models\DoctorCategoryI18n::find()
                            ->select(['name', 'parent_table_id'])
                            ->where(['language' => Yii::$app->language])
                            ->indexBy('parent_table_id')
                            ->column()
            ],
            'department_id',
            //'experience',
            //'email:email',
            //'phone',
            //'views',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
