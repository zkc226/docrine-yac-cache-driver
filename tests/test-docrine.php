<?php
/**
 * Created by PhpStorm.
 * User: zkc
 * Date: 2018-09-14
 * Time: 00:01
 */

require_once __DIR__ . '/../vendor/autoload.php';

$cache = new \zkc\Docrine\Cache\YacCache();

$cache->save('abc', ['123']);
var_dump($cache->fetch('abc'));
var_dump($cache->contains('abc'));