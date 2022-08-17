<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\StaticPage;
use app\models\ArticleCategory;
use app\models\Article;
use app\models\Department;
use app\models\Doctor;

/**
 * Description of Sitemap
 *
 * @author Velizar
 */
class Sitemap extends ActiveRecord {

    public function getUrl() {
        $urls = [];
        $host = Yii::$app->request->hostInfo; // Домен сайту
        $arrUrlLanguages = array_keys(Yii::$app->components['urlManager']['languages']);

//        $urls = [
//            0 => [
//                'url' => 'http://site.loc/en',
//                'lastmod' => '2018-06-04'
//            ],
//            1 => [
//                'url' => 'http://site.loc/nb',
//                'lastmod' => '2018-06-04'
//            ],
//            2 => [
//                'url' => 'http://site.loc/pl',
//            ],
//        ];

        #Головні сторінки (статичні, незмінні)
        foreach ($arrUrlLanguages as $urlLanguage) {
            $urls[] = [
                'url' => $host.'/'.$urlLanguage
            ];
            $urls[] = [
                'url' => $host.'/'.$urlLanguage.'/login'
            ];
            $urls[] = [
                'url' => $host.'/'.$urlLanguage.'/request-password-reset'
            ];
            $urls[] = [
                'url' => $host.'/'.$urlLanguage.'/signup'
            ];
        }

        #Головні сторінки (які змінюються - static_pages)
        $static_pages = StaticPage::find()
                ->select("alias, updated_at")
                ->where('`status` = :status')
                ->addParams([':status' => StaticPage::STATUS_ACTIVE])
                ->all();

        foreach ($static_pages as $static_page) {
            foreach ($arrUrlLanguages as $urlLanguage) {
                $urls[] = [
                    'url' => $host . '/' . $urlLanguage. '/site/' . $static_page->alias,
                    'lastmod' => date("Y-m-d", $static_page->updated_at)
                ];
            }
        }

        #Категорії статей (article_categories) /article-category/
        $article_categories = ArticleCategory::find()
                ->select("alias, updated_at")
                ->where('`status` = :status')
                ->addParams([':status' => ArticleCategory::STATUS_ACTIVE])
                ->all();

        foreach ($article_categories as $article_category) {
            foreach ($arrUrlLanguages as $urlLanguage) {
                $urls[] = [
                    'url' => $host . '/' . $urlLanguage. '/article-category/' . $article_category->alias,
                    'lastmod' => date("Y-m-d", $article_category->updated_at)
                ];
            }
        }

        #Статті (articles) /article/
        $articles = Article::find()
                ->select("alias, updated_at")
                ->where('`status` = :status')
                ->addParams([':status' => Article::STATUS_ACTIVE])
                ->all();

        foreach ($articles as $article) {
            foreach ($arrUrlLanguages as $urlLanguage) {
                $urls[] = [
                    'url' => $host . '/' . $urlLanguage. '/article/' . $article->alias,
                    'lastmod' => date("Y-m-d", $article->updated_at)
                ];
            }
        }

        #Лікарі (doctors) /doctor/
        $doctors = Doctor::find()
                ->select("id, updated_at")
                ->where('`status` = :status')
                ->addParams([':status' => Doctor::STATUS_ACTIVE])
                ->all();

        foreach ($doctors as $doctor) {
            foreach ($arrUrlLanguages as $urlLanguage) {
                $urls[] = [
                    'url' => $host . '/' . $urlLanguage . '/doctor/' . $doctor->id,
                    'lastmod' => date("Y-m-d", $doctor->updated_at)
                ];
            }
        }

        #відділення (departments) /department/
        $departments = Department::find()
                ->select("alias, updated_at")
                ->where('`status` = :status')
                ->addParams([':status' => Department::STATUS_ACTIVE])
                ->all();

        foreach ($departments as $department) {
            foreach ($arrUrlLanguages as $urlLanguage) {
                $urls[] = [
                    'url' => $host . '/' . $urlLanguage . '/department/' . $department->alias,
                    'lastmod' => date("Y-m-d", $department->updated_at)
                ];
            }
        }

        return $urls;
    }

    public function getXml($urls) {
        ob_start();
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($urls as $url) {
            echo '<url>';
                echo '<loc>' . $url['url'] . '</loc>';
                if (isset($url['lastmod'])) echo '<lastmod>' . $url['lastmod'] . '</lastmod>';
            echo '</url>';
        }
        echo '</urlset>';

        return ob_get_clean();
    }

}
