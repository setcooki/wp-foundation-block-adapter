<?php

namespace Setcooki\Wp\Foundation\Block\Adapter\Filter;

/**
 * Class Filter
 * @package Setcooki\Wp\Foundation\Block\Adapter\Filter
 */
abstract class Filter
{
    /**
     * @param mixed ...$args
     * @return mixed
     */
    abstract public function execute(...$args);
}
