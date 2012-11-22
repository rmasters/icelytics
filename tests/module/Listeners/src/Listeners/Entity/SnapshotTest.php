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
 * Tests Listeners\Entity\Snapshot
 *
 * @package Tests
 */
class SnapshotTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialState() {
        $created = new \DateTime;
        $snap = new Snapshot;

        $this->assertEquals(0, $snap->getListeners());
        $this->assertEquals($created, $snap->getTimestamp());

        $format = sprintf('%s - 0', $created->format('Y-m-d H:i:s O'));
        $this->assertEquals($format, (string) $snap);
    }

    public function testConstructor() {
        $timestamp = new \DateTime('2012-11-21 11:05:42 +0000');
        $snap = new Snapshot(103, $timestamp);

        $this->assertEquals(103, $snap->getListeners());
        $this->assertEquals($timestamp, $snap->getTimestamp());

        $format = sprintf('%s - 103', $timestamp->format('Y-m-d H:i:s O'));
        $this->assertEquals($format, (string) $snap);
    }
}
