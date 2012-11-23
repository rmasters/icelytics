<?php
/**
 * Icelytics
 *
 * @author    Ross Masters <ross@rossmasters.com>
 * @link      http://github.com/rmasters/icelytics
 * @copyright Copyright (c) 2012 Ross Masters
 * @license   http://github.com/rmasters/icelytics/blog/masters/LICENSE
 */

namespace Listeners\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Repository for Listeners\Entity\Snapshot
 *
 * @package Models
 */
class Snapshot extends EntityRepository
{
    /**
     * Find snapshots within a given time window
     * @param DateTime $start Time to search from
     * @param DateTime $end Time to search until
     * @param int $grouping Minutes to group by
     */
    public function findByTime(\DateTime $start, \DateTime $end, $grouping=15) {
        /**
         * DQL flavour
         * Will require custom DQL functions to be cross-platform
         *
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('s')
            ->from('Listeners\Entity\Snapshot', 's')
            ->where('s.timestamp >= :start')
            ->andWhere('s.timestamp <= :end')
            ->orderBy('s.timestamp', 'ASC')
            ->setParameter(':start', $start)
            ->setParameter(':end', $end);
        return $qb->getQuery()->getResult();
         */

        /**
         * Non-portable MySQL query
         *
         * Needs a custom UNIX_TIMESTAMP function in Doctrine to become DQL
         */
        $query = 'SELECT ' . 
                 'MIN(timestamp) AS timestamp, '.
                 'MAX(listeners) AS max_listeners, ' .
                 'MIN(listeners) AS min_listeners, ' .
                 'AVG(listeners) AS avg_listeners ' .
             'FROM listeners ' .
             'WHERE timestamp >= :start ' .
             'AND timestamp <= :end ' .
             'GROUP BY ROUND(UNIX_TIMESTAMP(timestamp)/(:grouping_mins*60)) ' .
             'ORDER BY timestamp DESC';

        $stmt = $this->getEntityManager()
            ->getConnection()
            ->prepare($query);
        $stmt->bindValue('start', $start->format('Y-m-d H:i:s'));
        $stmt->bindValue('end', $end->format('Y-m-d H:i:s'));
        $stmt->bindValue('grouping_mins', $grouping);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
