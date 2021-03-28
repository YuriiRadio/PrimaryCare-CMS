<?= "\t\t\t\t" ?><li>
<?= "\t\t\t\t\t" ?><a href="<?php echo yii\helpers\Url::to(['article-category/view', 'alias' => $item['alias']]) ?>"><?php if ($item['parent_id'] == 0) { echo '<b>'; }; echo $item['name']; if ($item['parent_id'] == 0) { echo '</b>'; }; ?>
<?php if( isset($item['childs']) ): ?>
<!--<span class="badge pull-right">+</span>--><?php endif; ?></a>
<?php if( isset($item['childs']) ): ?>
<?= "\t\t\t\t" ?><ul>
<?= $this->getMenuHtml($item['childs']) ?>
<?= "\t\t\t\t" ?></ul>
<?php endif; ?>
<?= "\t\t\t\t" ?></li><?= "\n" ?>