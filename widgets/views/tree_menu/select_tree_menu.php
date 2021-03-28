<option value="<?= $item['id'] ?>"
<?php
if ($item['id'] == $this->model->category_id) {
    echo ' selected';
}
?>
        ><?= $tab . $item['name'] ?></option>
<?php
if (isset($item['childs'])) {
    echo $this->getMenuHtml($item['childs'], $tab . '-');
}
?>