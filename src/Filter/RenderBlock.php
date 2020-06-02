<?php

namespace Setcooki\Wp\Foundation\Block\Adapter\Filter;

/**
 * Class RenderBlock
 * @package Setcooki\Wp\Foundation\Block\Adapter\Filter
 */
class RenderBlock extends Filter
{
    /**
     * @param mixed ...$args
     * @return mixed|void
     */
    public function execute(...$args)
    {
        $content = $args[0];
        $block = $args[1];

        if($block['blockName'] === 'core/columns')
        {
            $content = preg_replace('=\s*(?:\<div\s*class\=\"wp-block-columns([^"]*)\"([^>]*)\>)(.*)(?:\<\/div\>)$=ism', '<div class="wp-block-columns \\1" \\2 data-equalizer data-equalize-on="medium">\\3</div>', $content);
        }
        if($block['blockName'] === 'core/column')
        {
            $content = preg_replace('=\s*(\<div\s*class\=\"wp-block-column(?:[^"]*)\"(?:[^>]*)\>)(.*)(\<\/div\>)$=ism', '\\1<div class="wp-block-column-inner">\\2</div>\\3', $content);
        }
        return $content;
    }
}
