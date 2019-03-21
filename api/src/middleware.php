<?php
/**
 * Requests
 */
$app->add(new \App\Middlewares\Request\Json());

/**
 * Responses
 */
$app->add(new \App\Middlewares\Response\Exception());
$app->add(new \App\Middlewares\Response\Json());
