<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.j3qLrlO' shared service.

return $this->privates['.service_locator.j3qLrlO'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
    'evaluationElement' => ['privates', '.errored..service_locator.j3qLrlO.App\\Entity\\EvaluationElements', NULL, 'Cannot autowire service ".service_locator.j3qLrlO": it references class "App\\Entity\\EvaluationElements" but no such service exists.'],
], [
    'evaluationElement' => 'App\\Entity\\EvaluationElements',
]);
