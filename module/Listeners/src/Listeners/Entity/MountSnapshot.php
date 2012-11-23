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
 * A snapshot of the number of stream listeners on a given mount at a time
 *
 * @ORM\Entity
 * @ORM\Table(name="mount_listeners")
 * @package Models
 */
class MountSnapshot extends Snapshot
{
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $mountName;

    /**
     * Constructor
     *
     * @param string $mount Mount name
     * @param int $listeners Number of listeners
     * @param \DateTime|null $timestamp Timestamp of recording
     */
    public function __construct($mount=null, $listeners=0, \DateTime $timestamp=null) {
        $this->setMountName($mount);

        parent::__construct($listeners, $timestamp);
    }

    /**
     * Get the mount name
     * @return string
     */
    public function getMountName() {
        return $this->mountName;
    }

    /**
     * Set the mount name
     * @param string $mount Mount name
     * @return $this
     */
    public function setMountName($mount) {
        $this->mountName = $mount;
        return $this;
    }

    /**
     * The recording, formatted as '[airtime.mp3] 2012-11-22 22:55:00 - 23'
     * @return string
     */
    public function __toString() {
        return sprintf('[%s] %s - %d',
            $this->getMountName(),
            $this->getTimestamp()->format('Y-m-d H:i:s O'),
            $this->getListeners()
        );
    }

}
