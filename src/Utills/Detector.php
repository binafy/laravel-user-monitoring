<?php

namespace Binafy\LaravelUserMonitoring\Utills;

class Detector
{
    /**
     * Get browser list names.
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
     * Get device list names.
     *
     * @var array
     */
    public array $deviceName = [
        '/iPhone/i'           => 'iPhone',
        '/iPad/i'             => 'iPad',
        '/Android/i'          => 'Android Device',
        '/Windows/i'          => 'Windows',
    ];

    /**
     * Get browser name.
     */
    public function getBrowser(): string
    {
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
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        foreach ($this->deviceName as $pattern => $name) {
            if (preg_match($pattern, $userAgent)) {
                return $name;
            }
        }

        return 'Unknown Device Name';
    }
}
