<?php

/*
 * Yii2 adapter for PNotify JQuery extension
 *
 * @link      https://github.com/hiqdev/yii2-pnotify
 * @package   yii2-pnotify
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\pnotify;

use hiqdev\assets\pnotify\PNotifyAsset;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Class PNotify.
 * Yii2 support for PNotify JS plugin.
 *
 * Please, refer to https://github.com/sciactive/pnotify for detailed information about possible call options.
 */
class PNotify extends \yii\base\Widget
{
    /**
     * @var array options to be passed to PNotify JS call.
     */
    protected $_clientOptions = [
        'hide'    => true,
        'styling' => 'bootstrap3',
        'buttons' => [
            'sticker' => false,
        ],
    ];

    /**
     * @var array list of notifications. Will be merged with [[clientOptions]] before notification render
     */
    public $notifications = [];

    /**
     * @param array $value
     */
    public function setClientOptions($value)
    {
        $this->_clientOptions = $value;
    }

    public function getClientOptions()
    {
        return $this->_clientOptions;
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $this->registerClientScript();

        if (!is_array($this->notifications)) {
            throw new InvalidConfigException('Notifications list should be an array');
        }
        foreach ($this->notifications as $notification) {
            $this->registerNotification($notification);
        }
    }

    /**
     * Registers JS for PNotify plugin.
     * @param array $notification configuration array
     * @return void
     */
    protected function registerNotification(array $notification)
    {
        $view = $this->getView();

        $options = Json::encode(ArrayHelper::merge($this->getClientOptions(), $notification));
        $view->registerJs("new PNotify({$options});");
    }

    /**
     * Registers the needed JavaScript.
     * @return void
     */
    public function registerClientScript()
    {
        $view = $this->getView();
        PNotifyAsset::register($view);
    }
}
