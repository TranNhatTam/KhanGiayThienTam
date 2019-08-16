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
use frontend\models\ContactForm;
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
        $categories = Category::find()->orderBy(['priority' => SORT_DESC])->visible()->all();


        // Make by Boss
//        $orderDetails = OrderDetails::find()->select("COUNT(*) AS num_order,product_id")->groupBy(['product_id'])->orderBy(['num_order' => SORT_DESC])->limit(4)->all();
//        $productBestSeller = [];
//        foreach ($orderDetails as $orderDetail) {
//            if ($orderDetail->product) {
//                $productBestSeller[] = $orderDetail->product;
//            }
//        }
        $slider = Slider::find()->where(['status' => Slider::STATUS_PUBLISHED])->all();
        $productBestSeller= Product::find()->orderBy(['priority'=>SORT_DESC])->visible()->limit(4)->all();
        return $this->render('index', ['categories' => $categories, 'productBestSeller' => $productBestSeller, 'slider' => $slider]);
    }


    /**
     * @return string|Response
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => Yii::t('frontend', 'Thank you for contacting us. We will respond to you as soon as possible.'),
                    'options' => ['class' => 'alert-success']
                ]);
                return $this->refresh();
            } else {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => \Yii::t('frontend', 'There was an error sending email.'),
                    'options' => ['class' => 'alert-danger']
                ]);
            }
        }

        return $this->render('contact', [
            'model' => $model
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
}
