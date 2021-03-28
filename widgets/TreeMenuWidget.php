<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\widgets;

use Yii;
use yii\base\Widget;
//use app\models\ArticleCategory;

/**
 * Description of MenuWidget
 *
 * @author Velizar
 */
class TreeMenuWidget extends Widget {

    public $tpl;
    # 1article_cat_menu, 3select, 2select_article *** tree_menu+, select_tree_menu+, select_self_menu+
    # select_self_menu - select для редагування категорії
    # select_tree_menu - select для редагування статті
    # tree_menu- генерація дерева на сайті

    public $className;
    public $model;
    public $data;
    public $tree;
    public $menuHtml;
    public $alias = false;

    public function init() {
        parent::init();
        if ($this->tpl === NULL) {
            $this->tpl = 'tree_menu';
        }
    }

    public function run() {
        # get cache
        if ($this->tpl == 'tree_menu') {
            $menu = Yii::$app->cache->get('tree_menu-'.$this->className.'-'.Yii::$app->language);
            if ($menu) {
                return $menu;
            }
        }

        $className = $this->className;
        $this->data = $className::find()
                ->joinWith('i18n')
                ->select([$className::tableName().'.id', 'parent_id', 'name', 'alias'])
                ->indexBy('id')
                ->asArray()
                ->all();

        $this->tree = $this->getTree($this->data);
        $this->menuHtml = $this->getMenuHtml($this->tree);

        # set cache
        if ($this->tpl == 'tree_menu') {
            Yii::$app->cache->set('tree_menu-'.$this->className.'-'.Yii::$app->language, $this->menuHtml, Yii::$app->setting->get('CACHE.TIME_MENU'));
        }

        return $this->menuHtml;
    }

    protected function getTree($data) {
        $tree = [];
        foreach ($data as $id => &$node) {
            if (!$node['parent_id']) { // if (parent_id == 0)
                $tree[$id] = &$node;
            }
            else {
                $data[$node['parent_id']]['childs'][$node['id']] = &$node;
            }
        }
        return $tree;
    }

    protected function getMenuHtml($tree, $tab = '') {
        $str = '';
        foreach ($tree as $item) {
            $str .= $this->catToTemplate($item, $tab);
        }
        return $str;
    }

    protected function catToTemplate($item, $tab) {
        ob_start();
        include(__DIR__ . '/views/tree_menu/' . $this->tpl . '.php');
        return ob_get_clean();
    }

}