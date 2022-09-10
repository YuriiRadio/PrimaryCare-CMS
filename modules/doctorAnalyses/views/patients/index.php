<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PatientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lang', 'Patients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a(Yii::t('lang', 'Create Patients'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'pager' => [
            'class' => yii\bootstrap4\LinkPager::class
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            //'status',
            [
                'attribute' => 'status',
                'filter' => [1 => Yii::t('lang', 'Active'), 0 => Yii::t('lang', 'Inactive')],
                'value' => function ($model) {
                    return $model->status ? '<span class="text-success">' . Yii::t('lang', 'Active') . '</span>' : '<span class="text-danger">' . Yii::t('lang', 'Inactive') . '</span>';
                },
                'format' => 'html',
            ],
//            'our_patient',
            [
                'attribute' => 'our_patient',
                'filter' => [0 => Yii::t('lang', 'No'), 1 => Yii::t('lang', 'Yes')],
                'value' => function ($model) {
                   return $model->our_patient ? '<span class="text-success">' . Yii::t('lang', 'Yes') . '</span>' : '<span class="text-info">' . Yii::t('lang', 'No') . '</span>';
                },
                'format' => 'html',
            ],
            'name',
//            'birth',
            [
                'attribute' => 'birth',
                'format' => ['date', 'php:d.m.Y'],
            ],
            'declaration_number',
//            'doctor_id',
//            'doctor',
//            'sex',
            [
                'attribute' => 'sex',
                'filter' => [1 => Yii::t('lang', 'Male'), 0 => Yii::t('lang', 'Female'), 2 => Yii::t('lang', 'It')],
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
//            'created_at',
//            [
//                'attribute' => 'created_at',
//                'format' => ['date', 'php:d.m.Y']
//            ],
//             'updated_at:date',
            [
                'attribute' => 'updated_at',
//                'filter' => Html::input('date', 'PatientsSearch[updated_at]', ['class' => 'form-control']),
                'format' => ['date', 'php:d.m.Y'],
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
