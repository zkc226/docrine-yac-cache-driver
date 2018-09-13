<?php
/**
 * Created by PhpStorm.
 * User: zkc
 * Date: 2018-09-14
 * Time: 00:01
 */

require_once __DIR__ . '/../vendor/autoload.php';

$yac = new \Yac('');

var_dump($yac->get('abc'));
var_dump($yac->set('abc', '123'));
var_dump($yac->get('abc'));
var_dump($yac->delete('abc', 0));
var_dump($yac->flush());
var_dump($yac->info());

