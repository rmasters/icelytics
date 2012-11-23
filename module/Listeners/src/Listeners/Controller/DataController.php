<?php
/**
 * Icelytics
 *
 * @author    Ross Masters <ross@rossmasters.com>
 * @link      http://github.com/rmasters/icelytics
 * @copyright Copyright (c) 2012 Ross Masters
 * @license   http://github.com/rmasters/icelytics/blog/masters/LICENSE
 */

namespace Listeners\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class DataController extends AbstractActionController
{
    public function todayAction() {
        $start = new \DateTime;
        $start->setTime(0,0,0);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $end = new \DateTime;
        $start = clone $end;
        $start->sub(new \DateInterval('PT24H'));

        $snapshots = $em->getRepository('Listeners\Entity\Snapshot')
            ->findByTime($start, $end);

        // Build the array with type casting for JSON
        $data = array();
        foreach ($snapshots as $s) {
            $data[] = array(
                'timestamp' => $s['timestamp'],
                'max_listeners' => (int) $s['max_listeners'],
                'min_listeners' => (int) $s['min_listeners'],
                'avg_listeners' => (float) $s['avg_listeners'],
            );
        }

        return new JsonModel($data);
    }
}
