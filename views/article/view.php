<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $article->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Articles'), 'url' => ['/article']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-content">
    <h2><?= Html::encode($this->title) ?></h2>
    <ul class="list-unstyled list-inline small">
        <li class="list-inline-item">
            <i class="bi bi-calendar3"></i>
            <?= ' ' . date("Y.m.d", $article->created_at) ?>
        </li>
        <li class="list-inline-item">
            <i class="bi bi-eye-fill"></i>
            <?= $article->views ?>
        </li>
        <li class="list-inline-item">
            <i class="bi bi-card-list"></i>
            <a href="<?= Url::to(['article-category/view', 'id' => $article->articleCategory->id]) ?>"><?= $article->articleCategory->name ?></a>
        </li>
    </ul>
    <?php echo $article->body; ?>
    <?php
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()) {
            $link = Html::a(Yii::t('lang', 'Update'), ['admin/article/update', 'id' => $article->id], ['class' => 'btn btn-primary']);
            $options = ['class' => 'text-right'];
            echo Html::tag('div', $link, $options);
            echo '<br />';
        }
    ?>
</div>
