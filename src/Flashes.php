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

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Flashes widget renders messages from session flashes. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:.
 *
 * ```php
 * Yii::$app->getSession()->setFlash('error', 'This is the message');
 * Yii::$app->getSession()->setFlash('success', 'This is the message');
 * Yii::$app->getSession()->setFlash('info', 'This is the message');
 * ```
 *
 * Multiple messages could be set as follows:
 *
 * ```php
 * Yii::$app->getSession()->setFlash('error', ['Error 1', 'Error 2']);
 * ```
 */
class Flashes extends \yii\bootstrap\Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - $key is the name of the session flash variable
     * - $value is the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $alertTypes = [
        'error' => 'alert-danger',
        'danger' => 'alert-danger',
        'success' => 'alert-success',
        'info' => 'alert-info',
        'warning' => 'alert-warning',
    ];

    /**
     * @var array the options for rendering the close button tag
     */
    public $closeButton = [];

    /**
     * @param mixed $message Flash value to be normalized
     * @return array
     */
    public function normalizeMessage($message)
    {
        $res = [];
        if (is_string($message)) {
            $res['text'] = $message;
        } elseif (is_array($message)) {
            $res = $message;
        }

        return $res;
    }

    public function run()
    {
        $flashes = Yii::$app->getSession()->getAllFlashes();
        $notifications = [];

        foreach ($flashes as $type => $data) {
            if (isset($this->alertTypes[$type])) {
                $data = (array) $data;

                foreach ($data as $message) {
                    $message = $this->normalizeMessage($message);
                    $notifications[] = ArrayHelper::merge([
                        'type' => $type,
                    ], $message);
                }
                Yii::$app->getSession()->removeFlash($type);
            }
        }

        echo PNotify::widget([
            'notifications' => $notifications,
        ]);
    }
}
