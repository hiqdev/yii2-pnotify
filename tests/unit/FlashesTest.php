<?php

/*
 * Yii2 adapter for PNotify JQuery extension
 *
 * @link      https://github.com/hiqdev/yii2-pnotify
 * @package   yii2-pnotify
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\pnotify\tests\unit;

use hiqdev\pnotify\Flashes;

class FlashesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Flashes
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new Flashes();
    }

    protected function tearDown()
    {
    }

    public function testConstruct()
    {
        $this->assertInstanceOf(Flashes::class, $this->object);
    }
}
