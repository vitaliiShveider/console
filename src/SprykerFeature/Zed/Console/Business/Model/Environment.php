<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace SprykerFeature\Zed\Console\Business\Model;

use SprykerFeature\Shared\Library\Application\Environment as SprykerEnvironment;
use Symfony\Component\Process\Process;

class Environment
{

    public static function initialize()
    {
        defined('APPLICATION_ROOT_DIR')
            || define('APPLICATION_ROOT_DIR', realpath(__DIR__ . '/../../../../../../../../../../..'));

        defined('APPLICATION_SOURCE_DIR')
            || define('APPLICATION_SOURCE_DIR', APPLICATION_ROOT_DIR . '/src');

        defined('APPLICATION_VENDOR_DIR')
            || define('APPLICATION_VENDOR_DIR', APPLICATION_ROOT_DIR . '/vendor');

        defined('APPLICATION')
            || define('APPLICATION', 'ZED');

        defined('SYSTEM_UNDER_TEST')
            || define('SYSTEM_UNDER_TEST', false);

        self::buildClassMapIfNotPresent();

        SprykerEnvironment::initialize(APPLICATION, true);
    }

    private static function buildClassMapIfNotPresent()
    {
        if (!file_exists(APPLICATION_ROOT_DIR . '.class_map')) {
            $process = new Process('vendor/bin/build-class-map');
            $process->run();
        }
    }

}
