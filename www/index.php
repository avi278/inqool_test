<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

if ('https' === getenv('HTTP_X_FORWARDED_PROTO')) {
    \Nette\Http\Url::$defaultPorts['https'] = (int) getenv('SERVER_PORT');
 }

$configurator = App\Bootstrap::boot();
$container = $configurator->createContainer();
$application = $container->getByType(Nette\Application\Application::class);
$application->run();
