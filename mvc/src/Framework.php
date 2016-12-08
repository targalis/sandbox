<?php

/**
 * This file is part of the Zanra Framework package.
 *
 * (c) Targalis Group <targalisgroup@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Zanra\Framework\Application\Application;

/**
 * Zanra Framework
 *
 * @author Targalis
 *
 */
class Framework
{
    /**
     * @var Application
     */
    private $application;
	
    /**
     * @var Framework
     */
    private static $_instance = null;

    /**
     * Constructor.
     */
    private function __Construct()
    {
        $this->application = Application::getInstance();
        $this->application->loadConfig(__DIR__ .'/../config/resources.ini');
        $this->application->mvcHandle(new ErrorWrapper());
    }

    /**
     * Load framework.
     */
    public static function load()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Framework();
        }

        return self::$_instance;
    }
}
