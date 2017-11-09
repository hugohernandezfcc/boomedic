<?php

require_once __DIR__ . '/..' . '/helpers/VisaAPIClient.php';

//Por diferencias de composer...

	if (!class_exists('\PHPUnit_Framework_TestCase') && class_exists('\PHPUnit\Framework\TestCase'))
    class_alias('\PHPUnit\Framework\TestCase', '\PHPUnit_Framework_TestCase');

	if (!class_exists('\PHPUnit_Assert') && class_exists('\PHPUnit\Framework\Assert'))
    class_alias('\PHPUnit\Framework\Assert', '\PHPUnit_Framework_Assert');