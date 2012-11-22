<?php
/**
 * Icelytics
 *
 * @author    Ross Masters <ross@rossmasters.com>
 * @link      http://github.com/rmasters/icelytics
 * @copyright Copyright (c) 2012 Ross Masters
 * @license   http://github.com/rmasters/icelytics/blog/masters/LICENSE
 */

namespace Listeners\Entity;

/**
 * Tests Listeners\Entity\MountSnapshot
 *
 * @package Tests
 */
class MountSnapshotTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialState() {
        $created = new \DateTime;
        $snap = new MountSnapshot;

        $this->assertNull($snap->getMountName());

        $format = sprintf('[] %s - 0', $created->format('Y-m-d H:i:s O'));
        $this->assertEquals($format, (string) $snap);
    }

    public function testConstructor() {
        $timestamp = new \DateTime('2012-11-21 11:05:42 +0000');
        $snap = new MountSnapshot('test.mp3', 103, $timestamp);

        $this->assertEquals('test.mp3', $snap->getMountName());

        $format = '[test.mp3] 2012-11-21 11:05:42 +0000 - 103';
        $this->assertEquals($format, (string) $snap);
    }
}
