<?php

namespace app\controllers;

use Yii;
use app\models\Banner;
//use yii\data\Pagination;

/**
 * Description of BannerController
 *
 * @author Velizar
 */
class BannerController extends AppController {

    public function actionIndex() {

//        $query = Article::find()
//                ->with('articleCategory')
//                ->where(['status' => Article::STATUS_ACTIVE]);
//
//        $pages = new Pagination([
//            'totalCount' => $query->count(),
//            'pageSize' => 9,
//            'forcePageParam' => FALSE,
//            'pageSizeParam' => FALSE
//        ]);
//        $articles = $query->offset($pages->offset)->limit($pages->limit)->all();
//
//        return $this->render('index', ['articles' => $articles, 'pages' => $pages]);
    }

    public function actionView($id = null, $alias = null) {
        if (Yii::$app->request->isAjax) {
            $banner = null;
            $id = (int) Yii::$app->request->post('id');
            if (!is_null($id)) {
                $banner = Banner::find()
                        ->where('id = :id AND status = :status', [':id' => $id, ':status' => Banner::STATUS_ACTIVE])
                        ->one();
            }
    //        debug($banner, true);
    //        if (!is_null($alias)) {
    //            $alias = clearGetData($alias);
    //            $article = Article::find()
    //                    ->where('alias = :alias AND status = :status', [':alias' => $alias, ':status' => Article::STATUS_ACTIVE])
    //                    ->one();
    //        }

            if (empty($banner)) {
                throw new \yii\web\HttpException(404, Yii::t('lang', 'The requested page does not exist.'));
            }
            // Збільшуємо лічильник переглядів на 1
            $banner->clicks = (int) $banner->clicks + 1;
            $banner->detachBehavior('TimestampBehavior');
            $banner->save(false);

            //return $banner->url_link;
            return 1;
        }
        return 0;
    }

}