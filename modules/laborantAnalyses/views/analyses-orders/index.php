<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use yii\web\JsExpression;
use app\models\Patients;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnalysesOrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lang', 'Analyses Orders');
$this->params['breadcrumbs'][] = $this->title;

$dataListDoctors = \app\models\Doctor::find()
    ->joinWith('i18n')
    ->select([\app\models\DoctorI18n::tableName() . '.name', \app\models\Doctor::tableName() . '.id'])
    ->where(['status' => \app\models\Doctor::STATUS_ACTIVE])
    ->indexBy('id')
    ->column();
?>
<div class="analyses-orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::a(Yii::t('lang', 'Create Analyses Orders'), ['create'], ['class' => 'btn btn-success']) ?></p>

    <?php Pjax::begin(); ?>
    <?php
        $url_select2 = \yii\helpers\Url::to(['/laborant-analyses/analyses-orders/patients-list']);
        $arr_patient_ids = array_unique(array_column($dataProvider->getModels(), 'patient_id'));
        $dataListPatients = Patients::find()
            ->select(['name', 'id'])
            ->where(['IN', 'id', $arr_patient_ids])
            ->indexBy('id')
            ->column();
    ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'id',
                'filterOptions' => ['style' => 'width: 112px']
            ],
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
//            'patient_id',
            [
                'attribute' => 'patient_id',
                'filter' => \kartik\select2\Select2::widget([
                    'name' => 'patient_id',
                    'model' => $searchModel,
                    'attribute' => 'patient_id',
                    'data' => $dataListPatients,
                    'options' => ['placeholder' => Yii::t('lang', 'Patient search').'...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 4,
                        'language' => [
                            'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                        ],
                        'ajax' => [
                            'url' => $url_select2,
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ],
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function(patients) { return patients.text + " " + patients.birth; }'),
                        'templateSelection' => new JsExpression('function (patients) { return patients.text; }'),
                    ],
                ]),
                'filterOptions' => ['style' => 'width: 330px'],
                'value' => function ($model) use ($dataListPatients) {
                    return $dataListPatients[$model->patient_id];
                },
            ],
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
                'filterOptions' => ['style' => 'width: 210px'],
                'format' => ['date', 'php:d.m.Y']
            ],
//            [
//                'attribute' => 'updated_at',
//                'filter' => kartik\date\DatePicker::widget([
//                    'name' => 'dp_2',
////                    'type' => kartik\date\DatePicker::TYPE_INPUT,
//                    'model' => $searchModel,
//                    'attribute' => 'updated_at',
//                    'pluginOptions' => [
//                        'autoclose' => true,
//                        'format' => 'dd.mm.yyyy',
//                        'todayHighlight' => true
//                    ]
//                ]),
//                'format' => ['date', 'php:d.m.Y']
//            ],
//            'views',
//            [
//                'attribute' => 'views',
//                'filterOptions' => ['style' => 'width: 100px']
//            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
