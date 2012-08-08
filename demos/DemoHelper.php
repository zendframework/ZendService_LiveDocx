<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Service
 * @subpackage LiveDocx
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * @namespace
 */

namespace ZendService\LiveDocx;

use IntlDateFormatter;
use Locale;

/**
 * @category   Demos
 * @package    Demos_Zend_Service
 * @subpackage LiveDocx
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class DemoHelper
{
    /**
     * Name of configuration file stored in /demos/Zend/Service/LiveDocx/
     */
    const CONFIGURATION_FILE = 'DemoConfiguration.php';

    /**
     * LiveDocx registration URL
     */
    const REGISTRATION_URL = 'https://www.livedocx.com/user/account_registration.aspx';

    /**
     * Line length in characters (used to wrap long lines)
     */
    const LINE_LENGTH = 80;

    /**
     * Default locale
     */
    const LOCALE = 'en_US';


    /**
     * Return filename of configuration file (path + file)
     * @return string
     */
    public static function configurationFilename()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . self::CONFIGURATION_FILE;
    }

    /**
     * Return 'register LiveDocx account' URL
     * @return string
     */
    public static function registrationUrl()
    {
        return self::REGISTRATION_URL;
    }

    /**
     * Return true, if configuration file exists and constants
     * DEMOS_ZENDSERVICE_LIVEDOCX_FREE_USERNAME and
     * DEMOS_ZENDSERVICE_LIVEDOCX_FREE_PASSWORD have been set.
     *
     * @return boolean
     */
    public static function credentialsAvailable()
    {
        $ret = false;

        $filename = self::configurationFilename();
        if (is_file($filename) && is_readable($filename)) {
            include_once $filename;
            if (defined('DEMOS_ZENDSERVICE_LIVEDOCX_FREE_USERNAME') &&
                defined('DEMOS_ZENDSERVICE_LIVEDOCX_FREE_PASSWORD') &&
                false !== DEMOS_ZENDSERVICE_LIVEDOCX_FREE_USERNAME  &&
                false !== DEMOS_ZENDSERVICE_LIVEDOCX_FREE_PASSWORD ) {
                    $ret = true;
                }
        }

        return $ret;
    }

    /**
     * Return instructions on how to register to use LiveDocx service and enter
     * username and password into configuration file.
     *
     * @return string
     */
    public static function credentialsHowTo()
    {
        $dir  =  dirname(self::configurationFilename());
        $file = basename(self::configurationFilename());
        $url  = self::registrationUrl();

        $ret  =                                                                               PHP_EOL;
        $ret .= sprintf('ERROR: LIVEDOCX USERNAME AND PASSWORD HAVE NOT BEEN SET.%s',         PHP_EOL);
        $ret .=                                                                               PHP_EOL;
        $ret .= sprintf('1. Using a web browser, register to use the LiveDocx service at:%s', PHP_EOL);
        $ret .= sprintf('   %s%s',                                                            $url, PHP_EOL);
        $ret .= sprintf('   (takes less than 1 minute).%s',                                   PHP_EOL);
        $ret .=                                                                               PHP_EOL;
        $ret .= sprintf('2. Change directory into:%s',                                        PHP_EOL);
        $ret .= sprintf('   %s%s',                                                            $dir, PHP_EOL);
        $ret .=                                                                               PHP_EOL;
        $ret .= sprintf('3. Copy %s.dist to %s.%s',                                           $file, $file, PHP_EOL);
        $ret .=                                                                               PHP_EOL;
        $ret .= sprintf('4. Open %s in a text editor and enter the username%s',               $file, PHP_EOL);
        $ret .= sprintf('   and password you obtained in step 1 (lines 42 and 43).%s',        PHP_EOL);
        $ret .=                                                                               PHP_EOL;
        $ret .= sprintf('5. Save and close %s.%s',                                            $file, PHP_EOL);
        $ret .=                                                                               PHP_EOL;
        $ret .= sprintf('6. Rerun this demonstration application.%s',                         PHP_EOL);
        $ret .=                                                                               PHP_EOL;

        return $ret;
    }

    /**
     * Decorator to format return value of list methods
     *
     * @param array $result
     * @return string
     */
    public static function listDecorator($result)
    {
        $ret = '';

        $locale = Locale::getDefault();

        $intlDateFormatter = new IntlDateFormatter($locale,
                IntlDateFormatter::LONG, IntlDateFormatter::LONG);

        if (count($result) > 0) {
            foreach ($result as $record) {
                $createTimeFormatted = $intlDateFormatter->format($record['createTime']);
                $modifyTimeFormatted = $intlDateFormatter->format($record['modifyTime']);
                $ret .= sprintf('         Filename  : %s%s', $record['filename'], PHP_EOL);
                $ret .= sprintf('         File Size : %d b%s', $record['fileSize'], PHP_EOL);
                $ret .= sprintf('     Creation Time : %d (%s)%s', $record['createTime'], $createTimeFormatted, PHP_EOL);
                $ret .= sprintf('Last Modified Time : %d (%s)%s', $record['modifyTime'], $modifyTimeFormatted, PHP_EOL);
                $ret .= PHP_EOL;
            }
        }

        return $ret;
    }

    /**
     * Decorator to format array
     *
     * @param array $result
     * @return string
     */
    public static function arrayDecorator($result)
    {
        $ret = '';
        $count = count($result);
        if ($count > 0) {
            for ($i = 0; $i < $count; $i ++) {
                $ret .= $result[$i];
                if ($count === ($i + 1)) {
                    $ret .= '.';
                } elseif ($count === ($i + 2)) {
                    $ret .= ' & ';
                } else {
                    $ret .= ', ';
                }
            }
        } else {
            $ret .= 'none';
        }
        return $ret;
    }

    /**
     * Print line, wrapped at self::LINE_LENGTH th character
     *
     * @param string $str
     * @return string
     */
    public static function printLine($str)
    {
        print wordwrap($str, self::LINE_LENGTH);
    }

    /**
     * Print result line like in a table of contents i.e.:
     *
     * n: XXX YYY ZZZ....ZZZ
     *
     * @param $counter
     * @param $testString
     * @param $testResult
     */
    public static function printLineToc($counter, $testString, $testResult)
    {
        $lineLength = self::LINE_LENGTH;

        //                        counter     result
        $padding = $lineLength - (4 + strlen(TEST_PASS));

        $counter    = sprintf('%2s: ', $counter);
        $testString = str_pad($testString, $padding, '.', STR_PAD_RIGHT);

        printf('%s%s%s%s', $counter, $testString, $testResult, PHP_EOL);
    }

    /**
     * Return the current time, formatted by default locale
     * e.g. 9:05 AM
     *
     * @return string
     */
    public static function currentTime()
    {
        $locale    = Locale::getDefault();
        $timestamp = time();

        $intlTimeFormatter = new IntlDateFormatter($locale,
                IntlDateFormatter::NONE, IntlDateFormatter::SHORT);

        return $intlTimeFormatter->format($timestamp);
    }

    /**
     * Return the current date, formatted by default locale
     * e.g. July 31, 2012
     *
     * @return string
     */
    public static function currentDate()
    {
        $locale    = Locale::getDefault();
        $timestamp = time();

        $intlDateFormatter = new IntlDateFormatter($locale,
                IntlDateFormatter::LONG, IntlDateFormatter::NONE);

        return $intlDateFormatter->format($timestamp);
    }

    /**
     * Return the current month and year, formatted by default locale
     * e.g. July 2012
     *
     * @return string
     */
    public static function currentMonthYear()
    {
        $locale    = Locale::getDefault();
        $timestamp = time();

        $intlDateFormatter = new IntlDateFormatter($locale, null, null, null, null, 'LLLL yyyy');

        return $intlDateFormatter->format($timestamp);
    }

}