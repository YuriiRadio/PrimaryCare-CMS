<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

//$this->title = Yii::t('lang', 'Search');
$this->params['breadcrumbs'][] = Yii::t('lang', 'Search');
?>
<div class="site-search">
    <h3><?= Yii::t('lang', 'Search results').': <span style="background-color:#FFFF00">'.$model->search.'</span>' ?></h3>

<?php if (!empty($model->doctors)): ?>
    <?php $i = 1; foreach ($model->doctors as $doctor): ?>
    <p><?= '<b><span style="background-color:#00FF00">'.$i.') '.Yii::t('lang', 'doctor').'</span></b> - '.Html::a('<span style="font-size:20px">'.$doctor['i18n']['name'].'</span>', ['doctor/view', 'id' => $doctor['id']]) ?></p>
    <?php $i++; endforeach; ?>
<?php else: ?>
    <h4><?= Yii::t('lang', 'There are no records in the database') ?></h4>
<?php endif; ?>

    <p><?php //echo debug($model) ?></p>

</div>
