<?php

namespace frontend\controllers;

use cheatsheet\Time;
use common\models\Article;
use common\models\ArticleCategory;
use common\models\Brand;
use common\models\Category;
use common\models\OrderDetails;
use common\models\Product;
use common\models\Slider;
use common\sitemap\ArticleUrlGenerator;
use common\sitemap\PageUrlGenerator;
use common\sitemap\UrlsIterator;
use backend\models\ContactForm;
use yii\data\Pagination;
use function GuzzleHttp\Promise\all;
use Sitemaped\Element\Urlset\Urlset;
use Sitemaped\Sitemap;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\PageCache;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => PageCache::class,
                'only' => ['sitemap'],
                'duration' => Time::SECONDS_IN_AN_HOUR,
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ],
            'set-locale' => [
                'class' => 'common\actions\SetLocaleAction',
                'locales' => array_keys(Yii::$app->params['availableLocales'])
            ]
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $slider = Slider::find()->where(['status' => 1])->orderBy(['order' => SORT_ASC])->all();
        $category = Category::find()->visible()->all();

        return $this->render('index', [
            'slider' => $slider,
            'category' => $category,
        ]);
    }


    /**
     * @return string|Response
     */
    public function actionContact()
    {
        $modelContact = new ContactForm();
        if ($modelContact->load(Yii::$app->request->post())) {

            if ($modelContact->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => Yii::t('frontend', 'Thank you for contacting us. We will respond to you as soon as possible.'),
                    'options' => ['class' => 'alert-success']
                ]);
                return $this->refresh();
            }

            Yii::$app->getSession()->setFlash('alert', [
                'body' => \Yii::t('frontend', 'There was an error sending email.'),
                'options' => ['class' => 'alert-danger']
            ]);
        }

        return $this->render('contact', [
            'modelContact' => $modelContact
        ]);

    }

    /**
     * @param string $format
     * @param bool $gzip
     * @return string
     */
    public function actionSitemap($format = Sitemap::FORMAT_XML, $gzip = false)
    {
        $links = new UrlsIterator();
        $sitemap = new Sitemap(new Urlset($links));

        Yii::$app->response->format = Response::FORMAT_RAW;

        if ($gzip === true) {
            Yii::$app->response->headers->add('Content-Encoding', 'gzip');
        }

        if ($format === Sitemap::FORMAT_XML) {
            Yii::$app->response->headers->add('Content-Type', 'application/xml');
            $content = $sitemap->toXmlString($gzip);
        } else if ($format === Sitemap::FORMAT_TXT) {
            Yii::$app->response->headers->add('Content-Type', 'text/plain');
            $content = $sitemap->toTxtString($gzip);
        } else {
            throw new BadRequestHttpException('Unknown format');
        }

        $linksCount = $sitemap->getCount();
        if ($linksCount > 50000) {
            Yii::warning(\sprintf('Sitemap links count is %d'), $linksCount);
        }

        return $content;
    }

    public function actionBlog()
    {
        return $this->render('blog');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionGallery()
    {
        return $this->render('gallery');
    }

    public function actionCreateContact()
    {
        var_dump(1);
        die;
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            ContactForm::sendContactEmail($model);
            Yii::$app->getSession()->setFlash('alertSuccess', 'Yêu cầu của bạn đã được chấp thuận.');

        } else {
            Yii::$app->getSession()->setFlash('alertFail', 'Có lỗi trong quá trình xử lý.');
        }
        return $this->redirect('contact');
    }


}
