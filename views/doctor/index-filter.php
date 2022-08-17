<?php
/* @var $this yii\web\View */

//$this->title = 'My Yii Application';
use yii\helpers\Html;
//use yii\widgets\LinkPager;
use yii\bootstrap4\LinkPager;

?>

<?php if (!empty($doctors)): ?>
<?php $count = count($doctors); $i = 0; foreach ($doctors as $doctor): ?>
<?php if (($i == 0) || ($i % 3 == 0)): ?><div class="row"><?php endif; ?>
            <div class="col-12 col-md-4">
                <div class="card doctor-card wow fadeInUp" data-wow-delay=".<?= $i ?>s">
                    <div class="card-img-top embed-responsive embed-responsive-4by3">
                        <?= Html::img('@web/web/uploads/doctor-fotos/small/'.$doctor->imageSmall, ['alt' => $doctor->name, 'class' => 'embed-responsive-item']) ?>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><?= $doctor->name ?></h4>
                        <p><b><?= Yii::t('lang', 'Specialization') ?>:&nbsp;</b><?= $doctor->specialization->name ?></p>
                        <p><b><?= Yii::t('lang', 'Category') ?>:&nbsp;</b><?= $doctor->category->name ?></p>
                        <p><b><?= Yii::t('lang', 'Experience') ?>:&nbsp;</b><?= $doctor->experience.Yii::t('lang', 'Y.') ?></p>
                        <p><b><?= Yii::t('lang', 'Work place') ?>:&nbsp;</b><?= Html::a($doctor->department->name, ['department/view', 'id' => $doctor->department_id]) ?></p>
<!--                            <a href="#" onclick="doctorQuickView(<?php // echo $doctor->id ?>)" class="btn btn-primary" role="button" title="<?php // echo Yii::t('lang', 'Quick view') ?>">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a>-->
                            <?= Html::a(Yii::t('lang', 'View'), ['doctor/view', 'id' => $doctor->id], ['class' => 'btn btn-info', 'title' => Yii::t('lang', 'Detailed view')]) ?><br />
                    </div>
                </div>
            </div><!--col-sm-4 col-md-4 col-lg-4-->
<?php $i++; if ($i % 3 == 0 || $i == $count ): ?></div><?php endif; ?>
<?php endforeach; ?>
<?php echo LinkPager::widget(['pagination' => $pages]); ?>
<?php else: ?>
<h4><?= Yii::t('lang', 'There are no records in the database') ?></h4>
<?php endif; ?>