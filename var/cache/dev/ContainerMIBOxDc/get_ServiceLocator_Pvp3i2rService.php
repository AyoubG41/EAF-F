<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.Pvp3i2r' shared service.

return $this->privates['.service_locator.Pvp3i2r'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
    'preferencesRepository' => ['privates', 'App\\Repository\\PreferencesRepository', 'getPreferencesRepositoryService.php', true],
], [
    'preferencesRepository' => 'App\\Repository\\PreferencesRepository',
]);