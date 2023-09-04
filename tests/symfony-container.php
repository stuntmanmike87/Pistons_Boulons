<?php declare(strict_types=1);

use App\Kernel;

//require __DIR__ . '/bootstrap.php';

$appKernel = new Kernel('tests', false);
$appKernel->boot();

return $appKernel->getContainer();
