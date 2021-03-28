<?= "\t\t\t\t" ?><li>
<?= "\t\t\t\t\t" ?><a href="<?php if ($this->alias) {echo yii\helpers\Url::to([strtolower(explode('\\',$this->className)[2]).'/view', 'alias' => $item['alias']]);} else {echo yii\helpers\Url::to([strtolower(explode('\\',$this->className)[2]).'/view', 'id' => $item['id']]);} ?>"><?php if ($item['parent_id'] == 0) { echo '<b>'; }; echo $item['name']; if ($item['parent_id'] == 0) { echo '</b>'; }; ?>
<?php if( isset($item['childs']) ): ?>
<!--<span class="badge pull-right">+</span>--><?php endif; ?></a>
<?php if( isset($item['childs']) ): ?>
<?= "\t\t\t\t" ?><ul>
<?= $this->getMenuHtml($item['childs']) ?>
<?= "\t\t\t\t" ?></ul>
<?php endif; ?>
<?= "\t\t\t\t" ?></li><?= "\n" ?>