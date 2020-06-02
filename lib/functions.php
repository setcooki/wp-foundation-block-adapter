<?php

/**
 * @param null $key
 * @return array|mixed|string
 */
function wpfba_version($key = null)
{
    if(!isset($GLOBALS['wpfba-version']))
    {
        if(is_file(get_stylesheet_directory() . '/VERSION'))
        {
            $file = get_stylesheet_directory() . '/VERSION';
        }else if(is_file(dirname(__FILE__) . '/../../../../VERSION')) {
            $file = dirname(__FILE__) . '/../../../../VERSION';
        }else{
            $file = rtrim(ABSPATH, DIRECTORY_SEPARATOR) . '/VERSION';
        }
        if(is_file($file) && ($version = @file_get_contents($file)) !== false && preg_match('=^v([0-9]{1,})\.([0-9]{1,})\.([0-9]{1,})\-([0-9]{1,})\-(.*)$=i', $version, $m))
        {
            $GLOBALS['wpfba-version'] = array
            (
                'full' => $m[0],
                'version' => vsprintf('%d.%d.%d-%d', [$m[1], $m[2], $m[3], $m[4]]),
                'major' => $m[1],
                'minor' => $m[2],
                'patch' => $m[3],
                'commit' => $m[4],
                'head' => $m[5]
            );
        }
    }
    if(isset($GLOBALS['wpfba-version']) && !empty($GLOBALS['wpfba-version']))
    {
        if(!empty($key) && array_key_exists($key, $GLOBALS['wpfba-version']))
        {
            return $GLOBALS['wpfba-version'][$key];
        }else{
            return $GLOBALS['wpfba-version'];
        }
    }
    return '';
}
