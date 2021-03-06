<?php
/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 19/10/2018
 * Time: 12:48 AM
 */

namespace dtsmart\helper;

use Yii;

/**
 * Class RecentlyViewContainer
 */
class RecentlyViewContainer extends \yii\base\Component
{

    public $items = [];
    public $limit = 6;
    public $sessionID = "recentlyProd";

    /**
     * Init
     */
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $session = Yii::$app->session;
        if ($session->has($this->sessionID)) {
            $this->items = $session->get($this->sessionID);
        } else {
            $this->items = [];
        }
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param $object \yii\base\BaseObject
     */
    public function addItem($object)
    {
        if (count($this->items) >= $this->limit) {
            array_shift($this->items);
        }
        $this->items[] = $object;

    }

    public function save()
    {
        $session = Yii::$app->session;
        $session->set($this->sessionID, $this->items);

    }

    public function remove($key)
    {
        unset($this->items[$key]);
    }

}