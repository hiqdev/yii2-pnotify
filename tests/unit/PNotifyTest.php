<?php
/**
 * Yii2 adapter for PNotify JQuery extension
 *
 * @link      https://github.com/hiqdev/yii2-pnotify
 * @package   yii2-pnotify
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\pnotify\tests\unit;

use hiqdev\pnotify\PNotify;

class PNotifyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PNotify
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new PNotify();
    }

    protected function tearDown()
    {
    }

    public function testConstruct()
    {
        $this->assertInstanceOf(PNotify::class, $this->object);
    }
}
