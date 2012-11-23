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

use Doctrine\ORM\Mapping as ORM;

/**
 * A snapshot of the total stream listeners at a time
 *
 * @ORM\Entity(repositoryClass="Listeners\Entity\Repository\Snapshot")
 * @ORM\Table(name="listeners")
 * @package Models
 */
class Snapshot
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $timestamp;

    /**
     * @ORM\Column(type="integer")
     */
    protected $listeners;

    /**
     * Constructor
     *
     * @param int $listeners Number of listeners
     * @param \DateTime|null $timestamp Timestamp of recording
     */
    public function __construct($listeners=0, $timestamp=null) {
        $this->setListeners($listeners);
        $this->setTimestamp($timestamp);
    }

    /**
     * Get the snapshot ID
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Disallow setting the ID
     * @param int $id
     * @throws \Exception
     */
    public function setId($id) {
        throw new \Exception('Snapshot IDs are automatically generated on persisting.');
    }

    /**
     * Get the timestamp of the recording
     * @return \DateTime
     */
    public function getTimestamp() {
        return $this->timestamp;
    }

    /**
     * Set the timestamp the recording was made
     * @param \DateTime|null $timestamp A DateTime instance, or null for now
     * @return $this
     */
    public function setTimestamp(\DateTime $timestamp=null) {
        if (null === $timestamp) {
            $this->timestamp = new \DateTime;
        } else {
            $this->timestamp = $timestamp;
        }

        return $this;
    }

    /**
     * Get the number of listeners
     * @return int
     */
    public function getListeners() {
        return $this->listeners;
    }

    /**
     * Set the number of listeners
     * @param int $listeners
     * @return $this
     */
    public function setListeners($listeners) {
        if ($listeners < 0) {
            $this->listeners = 0;
        } else {
            $this->listeners = (int) $listeners;
        }

        return $this;
    }

    /**
     * The recording, formatted as '2012-11-22 22:55:00 - 23'
     * @return string
     */
    public function __toString() {
        return sprintf('%s - %d',
            $this->getTimestamp()->format('Y-m-d H:i:s O'),
            $this->getListeners()
        );
    }

    /**
     * Get a copy of the entity as an array
     * @return array
     */
    public function getArrayCopy() {
        return array(
            'timestamp' => $this->getTimestamp(),
            'listeners' => $this->getListeners()
        );
    }
}
