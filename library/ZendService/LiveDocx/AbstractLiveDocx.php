<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Service
 */

namespace ZendService\LiveDocx;

use Traversable;
use Zend\Soap\Client as SoapClient;
use Zend\Stdlib\ArrayUtils;

/**
 * @category   Zend
 * @package    Zend_Service
 * @subpackage LiveDocx
 */
abstract class AbstractLiveDocx
{
    /**
     * LiveDocx service version.
     * @since LiveDocx 1.0
     */
    const VERSION = '2.1';

    /**
     *
     * @since LiveDocx 2.1
     */
    const SERVICE_FREE = 'free';

    /**
     *
     * @since LiveDocx 2.1
     */
    const SERVICE_PREMIUM = 'premium';


    /**
     * SOAP client used to connect to LiveDocx service.
     * @var   \Zend\Soap\Client
     * @since LiveDocx 1.0
     */
    protected $soapClient = null;

    /**
     * WSDL of LiveDocx service.
     * @var   string
     * @since LiveDocx 1.0
     */
    protected $wsdl = null;

    /**
     * Array of credentials (username and password) to log into LiveDocx service.
     * @var   array
     * @since LiveDocx 1.2
     */
    protected $credentials = array();

    /**
     * Status of connection to LiveDocx service.
     * When set to true, session is logged into LiveDocx service.
     * When set to false, session is not logged into LiveDocx service.
     * @var   boolean
     * @since LiveDocx 1.2
     */
    protected $isLoggedIn = null;

    /**
     * Free or premium service.
     * @var   string
     * @since LiveDocx 2.1
     */
    protected $service = null;


    /**
     * Constructor.
     *
     * Optionally, pass an array of options or Traversable object.
     *
     * @param  array|Traversable $options
     * @since  LiveDocx 1.0
     */
    public function __construct($options = null)
    {
        $this->setIsLoggedIn(false);

        if ($options instanceof Traversable) {
            $options = ArrayUtils::iteratorToArray($options);
        }

        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * Clean up and log out of LiveDocx service.
     *
     * @return boolean
     * @since  LiveDocx 1.0
     */
    public function __destruct()
    {
        return $this->logOut();
    }

    /**
     * Set options. Valid options are username, password and soapClient.
     *
     * @param  array $options
     * @throws Exception\InvalidArgumentException
     * @return AbstractLiveDocx
     * @since  LiveDocx 1.2
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $method = 'set' . $key;
            if (!method_exists($this, $method)) {
                throw new Exception\InvalidArgumentException(sprintf(
                    'Invalid option specified - "%s"', $key
                ));
            }
            $this->$method($value);
        }

        return $this;
    }

    /**
     * Set SOAP client.
     *
     * @param  \Zend\Soap\Client $soapClient
     * @return AbstractLiveDocx
     * @since  LiveDocx 1.2
     */
    public function setSoapClient($soapClient)
    {
        $this->soapClient = $soapClient;

        return $this;
    }

    /**
     * Get SOAP client.
     *
     * @return \Zend\Soap\Client
     * @since  LiveDocx 1.2
     */
    public function getSoapClient()
    {
        return $this->soapClient;
    }

    /**
     * Instantiate SOAP client.
     *
     * @param  string $endpoint
     * @return void
     * @since  LiveDocx 1.2
     */
    protected function initSoapClient($endpoint)
    {
        $this->soapClient = new SoapClient();
        $this->soapClient->setWsdl($endpoint);
    }

    /**
     * Set username.
     *
     * @return AbstractLiveDocx
     * @since  LiveDocx 1.0
     */
    public function setUsername($username)
    {
        $this->credentials['username'] = $username;

        return $this;
    }

    /**
     * Return username.
     *
     * @return string|null
     * @since  LiveDocx 1.0
     */
    public function getUsername()
    {
        if (isset($this->credentials['username'])) {
            return $this->credentials['username'];
        }

        return null;
    }

    /**
     * Set password.
     *
     * @return AbstractLiveDocx
     * @since  LiveDocx 1.0
     */
    public function setPassword($password)
    {
        $this->credentials['password'] = $password;

        return $this;
    }

    /**
     * Return password.
     *
     * @return string|null
     * @since  LiveDocx 1.0
     */
    public function getPassword()
    {
        if (isset($this->credentials['password'])) {
            return $this->credentials['password'];
        }

        return null;
    }

    /**
     * Set WSDL of LiveDocx service.
     *
     * @return AbstractLiveDocx
     * @since  LiveDocx 1.0
     */
    public function setWsdl($wsdl)
    {
        $this->wsdl = $wsdl;

        return $this;
    }

    /**
     * Return WSDL of LiveDocx service.
     *
     * @return AbstractLiveDocx
     * @since  LiveDocx 1.0
     */
    public function getWsdl()
    {
        if (null !== $this->getSoapClient()) {
            return $this->getSoapClient()->getWsdl();
        } else {
            return $this->wsdl;
        }
    }

    /**
     * Set service.
     *
     * @return AbstractLiveDocx
     * @since  LiveDocx 2.1
     */
    public function setService($service)
    {
        if (!in_array($service, array(self::SERVICE_FREE, self::SERVICE_PREMIUM))) {
            throw new Exception\RuntimeException(
                'Service must be either self::SERVICE_FREE or self::SERVICE_PREMIUM.'
            );
        }

        $this->service = $service;

        $wsdl = $this->buildWsdl($this->getService(), $this->getUsername(), $this->getVersion());

        $this->setWsdl($wsdl);

        return $this;
    }

    /**
     * Return service.
     *
     * @return string|null
     * @since  LiveDocx 2.1
     */
    public function getService()
    {
        if (isset($this->service)) {
            return $this->service;
        }

        return null;
    }

    /**
     * Return the document format (extension) of a filename.
     *
     * @param  string $filename
     * @return string
     * @since  LiveDocx 1.0
     */
    public function getFormat($filename)
    {
        return pathinfo($filename, PATHINFO_EXTENSION);
    }

    /**
     * Return the current API version.
     *
     * @return string
     * @since  LiveDocx 1.0
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Compare the current API version with another version.
     *
     * @param  string $version (STRING NOT FLOAT).
     * @return int -1 (version is less than API version), 0 (versions are equal), or 1 (version is greater than API version).
     * @since  LiveDocx 1.0
     */
    public function compareVersion($version)
    {
        return version_compare($version, $this->getVersion());
    }

    // -------------------------------------------------------------------------

    /**
     * Return logged into LiveDocx service status.
     * (true = logged in, false = not logged in).
     *
     * @return boolean
     * @since  LiveDocx 1.2
     */
    protected function getIsLoggedIn()
    {
        return $this->isLoggedIn;
    }

    /**
     * Set logged into LiveDocx service status.
     * (true = logged in, false = not logged in).
     *
     * @throws Exception\InvalidArgumentException
     * @return boolean
     * @since  LiveDocx 1.2
     */
    protected function setIsLoggedIn($state)
    {
        if (!is_bool($state)) {
            throw new Exception\InvalidArgumentException(
                'Logged in status must be boolean.'
            );
        }

        $this->isLoggedIn = $state;
    }

    // -------------------------------------------------------------------------

    /**
     * Log in to LiveDocx service.
     *
     * @param string $username
     * @param string $password
     * @throws Exception\InvalidArgumentException
     * @throws Exception\RuntimeException
     * @return boolean
     * @since  LiveDocx 1.2
     */
    protected function logIn()
    {
        if (false === $this->getIsLoggedIn()) {

            if (null === $this->getUsername()) {
                throw new Exception\InvalidArgumentException(
                    'Username has not been set. To set username specify the options array '
                  . 'in the constructor or call setUsername($username) after instantiation.'
                );
            }

            if (null === $this->getPassword()) {
                throw new Exception\InvalidArgumentException(
                    'Password has not been set. To set password specify the options array '
                  . 'in the constructor or call setPassword($password) after instantiation.'
                );
            }

            if (null === $this->getSoapClient()) {
                $this->initSoapClient($this->getWsdl());
            }

            try {
                @$this->getSoapClient()->LogIn(array(
                    'username' => $this->getUsername(),
                    'password' => $this->getPassword(),
                ));
                $this->setIsLoggedIn(true);
            } catch (\Exception $e) {
                throw new Exception\RuntimeException(
                    $e->getMessage()
                );
            }
        }

        return $this->isLoggedIn;
    }

    /**
     * Log out of the LiveDocx service.
     *
     * @throws Exception\RuntimeException
     * @return boolean
     * @since  LiveDocx 1.2
     */
    protected function logOut()
    {
        if ($this->getIsLoggedIn()) {
            try {
                $this->getSoapClient()->LogOut();
                $this->setIsLoggedIn(false);
            } catch (\Exception $e) {
                throw new Exception\RuntimeException(
                    $e->getMessage()
                );
            }
        }

        return $this->isLoggedIn;
    }

    // -------------------------------------------------------------------------

}