<?php

use yii\helpers\Url;
//use yii\widgets\LinkPager;
use yii\bootstrap4\LinkPager;
?>

<div class="row">

    <div class="col-sm-6 col-md-9">

<?php if (!empty($articles)): ?>
        <h2><?= Yii::t('lang', 'Articles'); ?></h2>
<?php $count = count($articles); $i = 0; foreach ($articles as $article): ?>
<?php if (($i == 0) || ($i % 3 == 0)): ?><div class="row"><?php endif; ?>
            <div class="col-xs-6 col-lg-4">
                <h3><a href="<?= Url::to(['article/view', 'id' => $article->id]); ?>"><?= $article->title ?></a></h3>
                <ul class="list-unstyled list-inline small">
                    <li class="list-inline-item">
                        <i class="bi bi-calendar3"></i>
                        <?= ' ' . date("Y.m.d", $article->created_at) ?>
                    </li>
                    <li class="list-inline-item">
                        <i class="bi bi-card-list"></i>
                        <a href="<?= Url::to(['article-category/view', 'id' => $article->articleCategory->id]) ?>"><?= $article->articleCategory->name ?></a>
                    </li>
                </ul>
                <p><?= \yii\helpers\StringHelper::truncateWords(strip_tags($article->body), 12, $suffix = '...');?>
                <a href="<?= Url::to(['article/view', 'id' => $article->id]); ?>"><?= Yii::t('lang', 'Forward')?>&raquo;</a>
                </p>
            </div><!--/.col-xs-6.col-lg-4-->
<?php $i++; if ($i % 3 == 0 || $i == $count ): ?></div><?php endif; ?>
<?php endforeach; ?>
<?php echo LinkPager::widget(['pagination' => $pages]); ?>
<?php else: ?>
<h4><?= Yii::t('lang', 'There are no records in the database') ?></h4>
<?php endif; ?>

    </div><!--col-sm-6 col-md-9-->

    <div class="col-sm-6 col-md-3">

        <div class="card panel-card">
            <div class="card-header"><b><?= Yii::t('lang', 'Articles')?></b></div>
            <div class="card-body">
                <ul id="tree_articles">
<?php echo app\widgets\TreeMenuWidget::widget(['tpl' => 'article_tree_menu', 'className' => \app\models\ArticleCategory::className()]); ?>
                </ul>
            </div>
        </div>

    </div><!--col-sm-6 col-md-3-->

</div><!--row-->




