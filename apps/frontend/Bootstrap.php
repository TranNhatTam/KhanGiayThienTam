<?php
/**
 * Nguyen Lieu Pha Che Si Project
 *
 * @copyright 2018 Nguyen An All Right Reserved
 * @link http://nguyenlieuphachesi.com
 */

namespace frontend;

use Yii;
use yii\base\BootstrapInterface;
use yii\caching\DbQueryDependency;

use common\models\Urls;
use yii\helpers\VarDumper;

/**
 * Bootstrap
 *
 * @package Nguyen Lieu Pha Che Si
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class Bootstrap implements BootstrapInterface
{

    /**
     * @var \yii\web\Application
     */
    protected $app;

    /**
     * @inheritdoc
     * @throws \yii\base\InvalidConfigException
     */
    public function bootstrap($app)
    {
        $this->app = $app;

        $app->urlManager->addRules($this->getUrlRulesFromDB());
    }


    /**
     * Get url rules from DB
     *
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    private function getUrlRulesFromDB(): array
    {
        Yii::beginProfile('Get url rules from db');
        $cache = $this->app->cache;

        if (!$rules = $cache->get(__METHOD__)) {
            $rules = [];
            $urls = Urls::find()->where(['is_deleted' => Urls::VISIBLE])->asArray()->all();

            foreach ($urls as $url) {
                $config = [
                    'defaults' => ['urlId' => $url['id'], 'format' => ''],
                    'pattern' => $url['route'] . '<format:(\.json)?>',
                ];

                if ($url['type'] == Urls::PRODUCT) {
                    $config['route'] = 'product/view';
                    $config['suffix'] = $url['suffix'] ?? $this->app->params['defaultItemUrlSuffix'];
                } elseif ($url['type'] == Urls::CATEGORY) {
                    $config['route'] = 'category/view';
                    $config['suffix'] = $url['suffix'] ?? $this->app->params['defaultCategoryUrlSuffix'];
                } elseif ($url['type'] == Urls::TAG) {
                    $config['route'] = 'tag/view';
                    $config['suffix'] = $url['suffix'] ?? $this->app->params['defaultTagUrlSuffix'];
                }

                $rules[] = $config;
            }

            $cache->set(__METHOD__, $rules, null, Yii::createObject([
                'class' => DbQueryDependency::class,
                'query' => Urls::find()
                    ->select(['updated_at', 'created_at'])
                    ->orderBy(['updated_at' => SORT_DESC, 'created_at' => SORT_DESC])
                    ->asArray()
                    ->limit(1)
            ]));
        }

        Yii::endProfile('Get url rules from db');

        return $rules;
    }

}