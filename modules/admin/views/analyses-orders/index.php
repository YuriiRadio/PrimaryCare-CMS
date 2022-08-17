<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AnalysesOrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lang', 'Analyses Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analyses-orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('lang', 'Create Analyses Orders'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php $dataListDoctors = \app\models\Doctor::find()
        ->joinWith('i18n')
        ->select([\app\models\DoctorI18n::tableName() . '.name', \app\models\Doctor::tableName() . '.id'])
        ->where(['status' => \app\models\Doctor::STATUS_ACTIVE])
        ->indexBy('id')
        ->column()
    ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'status',
                'filter' => [0 => Yii::t('lang', 'New'), 1 => Yii::t('lang', 'Edited'), 2 => Yii::t('lang', 'Done')],
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
                'filter' => $dataListDoctors,
                'value' => function ($model) use ($dataListDoctors) {
                    return $dataListDoctors[$model->doctor_id];
                },
            ],
            'patient_id',
            // 'created_at',
            [
                'attribute' => 'created_at',
                'filter' => kartik\date\DatePicker::widget([
                    'name' => 'dp_1',
//                    'type' => kartik\date\DatePicker::TYPE_INPUT,
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd.mm.yyyy',
                        'todayHighlight' => true
                    ]
                ]),
                'format' => ['date', 'php:d.m.Y']
            ],
//            'updated_at',
            [
                'attribute' => 'updated_at',
                'filter' => kartik\date\DatePicker::widget([
                    'name' => 'dp_2',
//                    'type' => kartik\date\DatePicker::TYPE_INPUT,
                    'model' => $searchModel,
                    'attribute' => 'updated_at',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd.mm.yyyy',
                        'todayHighlight' => true
                    ]
                ]),
                'format' => ['date', 'php:d.m.Y']
            ],
            'views',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
