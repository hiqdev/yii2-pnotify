<?php

namespace hiqdev\pnotify;

use hipanel\helpers\ArrayHelper;
use hiqdev\assets\pnotify\PNotifyAsset;
use yii\base\InvalidConfigException;
use yii\helpers\Json;

/**
 * Class PNotify
 * Yii2 support for PNotify JS plugin.
 *
 * Please, refer to https://github.com/sciactive/pnotify for detailed information about possible call options
 *
 * @package hiqdev\pnotify
 */
class PNotify extends \yii\base\Widget
{
    /**
     * @var array options that will be passed to PNotify JS call.
     */
    public $clientOptions = [];

    /**
     * @var array list of notifications. Will be merged with [[clientOptions]] before notification render
     */
    public $notifications = [];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
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
     * Registers JS for PNotify plugin
     * @param array $notification
     * @return void
     */
    protected function registerNotification(array $notification)
    {
        $view = $this->getView();

        $options = Json::encode(ArrayHelper::merge($this->clientOptions, $notification));
        $view->registerJs("new PNotify({$options});");
    }

    /**
     * Registers the needed JavaScript
     * @return void
     */
    public function registerClientScript()
    {
        $view = $this->getView();
        PNotifyAsset::register($view);
    }

}
