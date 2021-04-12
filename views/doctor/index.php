<?php
/* @var $this yii\web\View */

//$this->title = 'My Yii Application';
//use yii\bootstrap\Modal;
use yii\bootstrap4\Modal;
//use yii\helpers\Url;
use yii\helpers\Html;
//use yii\widgets\LinkPager;
use yii\bootstrap4\LinkPager;

$this->registerJsFile('@web/js/wow/wow.min.js', ['depends' => ['yii\web\YiiAsset']]);
$this->registerCssFile('@web/js/wow/animate.css', ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile('@web/js/doctor.js', ['depends' => ['yii\web\YiiAsset']])
?>

    <!--<span class="alert alert-info">До нового року залишилося: <b><span id="time_new_year"></span></b></span>-->
    <div class="jumbotron">
        <h1><?= Yii::t('lang', 'Congratulations!') ?></h1>
        <p><span style="font-size:44px">КНП "БЕРЕЗНІВСЬКИЙ ЦЕНТР ПМД"</span></p>
        <p><?= Html::a('Медична реформа 2018', ['article/view', 'alias' => 'medical-reform-2018']) ?> | <?= Html::a('Як обрати сімейного лікаря', ['article/view', 'alias' => 'how-to-choose-a-family-doctor']) ?></p>
        <p><?= Html::a(Yii::t('lang', 'Last events'), ['article-category/view', 'alias' => 'events']) ?></p>
    </div>

<div class="row">
    <div class="col-12 col-md-9">

        <div class="row" id="doctors">

<?php if (!empty($doctors)): ?>
<?php $count = count($doctors); $i = 0; foreach ($doctors as $doctor): ?>
<?php if (($i == 0) || ($i % 3 == 0)): ?><div class="row"><?php endif; ?>
            <div class="col-12 col-sm-4">
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

        </div><!--row-->

    </div><!--col-->

    <div class="col-12 col-md-3">

        <div class="card panel-card wow fadeInUp">
            <h6 class="card-header"><b><?= Yii::t('lang', 'Articles')?></b></h6>
            <div class="card-body">
                 <ul id="tree_articles">
<?php echo app\widgets\TreeMenuWidget::widget(['tpl' => 'article_tree_menu', 'className' => \app\models\ArticleCategory::className()]); ?>
                </ul>
            </div>
        </div>

        <div class="card panel-card wow fadeInUp">
            <h6 class="card-header"><b><?= Yii::t('lang', 'Doctor filters')?>:</b></h6>
            <div id="doctor_filters" class="card-body">
                <p><b><?= Yii::t('lang', 'Department') ?>:&nbsp;</b></p>
                <?php
                    empty($filters['department']) ? $selected = 0 : $selected = $filters['department'];
                    echo Html::dropDownList('department', $selected,
                    ([0 => Yii::t('lang', 'All')] + \app\models\Department::find()
                        ->joinWith('i18n')
                        ->select(['name', 'parent_table_id'])
                        //->where(['language' => Yii::$app->language])
                        ->where(['department_type_id' => 1])
                        ->indexBy('parent_table_id')
                        ->column())
                    );
                ?>
                <hr />
                <p><b><?= Yii::t('lang', 'Specialization') ?>:&nbsp;</b></p>
                <?php
                    empty($filters['specialization']) ? $selected = 0 : $selected = $filters['specialization'];
                    echo Html::dropDownList('specialization', $selected,
                    ([0 => Yii::t('lang', 'All')] + \app\models\DoctorSpecializationI18n::find()
                        ->select(['name', 'parent_table_id'])
                        ->where(['language' => Yii::$app->language])
                        ->indexBy('parent_table_id')
                        ->column())
                    );
                ?>
                <hr />
                <p><b><?= Yii::t('lang', 'Category') ?>:&nbsp;</b></p>
                <?php
                    empty($filters['category']) ? $selected = 0 : $selected = $filters['category'];
                    echo Html::dropDownList('category', $selected,
                    ([0 => Yii::t('lang', 'All')] + \app\models\DoctorCategoryI18n::find()
                        ->select(['name', 'parent_table_id'])
                        ->where(['language' => Yii::$app->language])
                        ->indexBy('parent_table_id')
                        ->column())
                    );
                ?>
                <hr />
                <p><b><?= Yii::t('lang', 'Declarations') ?>:&nbsp;</b></p>
                <?php
                    empty($filters['declarations']) ? $selected = 0 : $selected = $filters['declarations'];
                    echo Html::dropDownList('declarations', $selected,
                        [
                            0 => Yii::t('lang', 'All doctors'),
                            1 => Yii::t('lang', 'Free doctors'),
                        ]
                    );
                ?>
            </div>
        </div>

        <div class="card panel-card wow fadeInUp">
            <h6 class="card-header"><b><?= Yii::t('lang', 'Departments')?></b></h6>
            <div class="card-body">
                <ul id="tree_departments">
<?php echo app\widgets\TreeMenuWidget::widget(['tpl' => 'tree_menu', 'className' => app\models\Department::className(), 'alias' => true]); ?>
                </ul>
            </div>
        </div>

    </div><!--col-->

</div><!--row-->

<?php echo \app\widgets\BannerWidget::widget(['position' => 'bottom']); ?>

<?php
//Modal::begin([
//    'id' => 'doctor-modal',
//    'header' => '<h2>Say hello...</h2>',
//    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">'.Yii::t('lang', 'Close').'</button>',
//    //'toggleButton' => ['label' => 'click me'],
//]);
//echo 'Say hello...';
//Modal::end();
?>