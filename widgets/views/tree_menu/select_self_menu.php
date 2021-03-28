<option value="<?= $item['id'] ?>"
<?php
if ($item['id'] == $this->model->parent_id) {
    echo ' selected';
}
?>
<?php
if ($item['id'] == $this->model->id) {
    echo ' disabled';
}
?>
><?= $tab . $item['name'] ?></option>
<?php
if (isset($item['childs'])) {
    echo $this->getMenuHtml($item['childs'], $tab . '+');
}
?>