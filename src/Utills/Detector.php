<?php

namespace Binafy\LaravelUserMonitoring\Utills;

class Detector
{
    /**
     * An array of browser names.
     *
     * @var array
     */
    public array $browserName = [
        'Edge'      => 'Edge',
        'MSIE'      => 'Internet Explorer',
        'Trident'   => 'Internet Explorer',
        'Firefox'   => 'Firefox',
        'OPR'       => 'Opera',
        'Chrome'    => 'Chrome',
        'Safari'    => 'Safari',
        'Opera'     => 'Opera',
    ];

    /**
     * An array of device names.
     *
     * @var array
     */
    public array $deviceName = [
        '/windows nt 10/i'      =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    ];

    /**
     * Get browser name.
     */
    public function getBrowser(): string
    {
        if (PHP_SAPI === 'cli') {
            return 'CLI';
        }

        // On some servers, HTTP_USER_AGENT is not available
        if( !isset($_SERVER['HTTP_USER_AGENT'])) {
            return 'Unknown Browser';
        }

        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        foreach ($this->browserName as $key => $browser) {
            if (str_contains($userAgent, $key)) {
                return $browser;
            }
        }

        return 'Unknown Browser';
    }

    /**
     * Get device name.
     */
    public function getDevice(): string
    {
        if (PHP_SAPI === 'cli') {
            return 'CLI';
        }

        // On some servers, HTTP_USER_AGENT is not available
        if( !isset($_SERVER['HTTP_USER_AGENT'])) {
            return 'Unknown Device Name';
        }

        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        foreach ($this->deviceName as $pattern => $name) {
            if (preg_match($pattern, $userAgent)) {
                return $name;
            }
        }

        return 'Unknown Device Name';
    }
}
