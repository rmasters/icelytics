<?php
/**
 * Icelytics
 *
 * @author    Ross Masters <ross@rossmasters.com>
 * @link      http://github.com/rmasters/icelytics
 * @copyright Copyright (c) 2012 Ross Masters
 * @license   http://github.com/rmasters/icelytics/blog/masters/LICENSE
 */

/**
 * A script that randomly generates listener counts for testing, in the absence
 * of a real icecast server
 */

chdir(dirname(__DIR__));
include 'init_autoloader.php';
$app = Zend\Mvc\Application::init(include 'config/application.config.php');

$verbose = true;

// Start seeding
$em = $app->getServiceManager()->get('doctrine.entitymanager.orm_default');

$delay = 2;
$startingListeners = 3;

$mounts = array(
    'random.mp3' => $startingListeners,
);


$totalListeners = 0;
$sumFn = function ($value, $key) use (&$totalListeners) {
    $totalListeners += $value;
};

$run = 0;
while(true) {
    if ($run != 0) {
        foreach ($mounts as $name => $listeners) {
            $fluc = mt_rand(60, 180) / 100;
            $mounts[$name] = round($mounts[$name] * $fluc);

            if ($verbose) echo 'Fluctuation: ' . $fluc . PHP_EOL;
        }
    }

    foreach ($mounts as $name => $listeners) {
        $mountSnap = new Listeners\Entity\MountSnapshot($name, $listeners);
        $em->persist($mountSnap);

        if ($verbose) echo $mountSnap . PHP_EOL;
    }

    $totalListeners = 0;
    array_walk($mounts, $sumFn);
    $totalSnap = new Listeners\Entity\Snapshot($totalListeners);
    $em->persist($totalSnap);
    if ($verbose) echo 'Total: ' . $totalSnap . PHP_EOL;

    $em->flush();

    sleep($delay);
    ++$run;
}
