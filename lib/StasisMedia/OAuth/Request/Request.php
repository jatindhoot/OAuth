<?php
namespace StasisMedia\OAuth\Request;

/*
 * OAuth 1.0 request
 *
 * Base class will all default REQUIRED and OPTIONAL parameters
 * http://tools.ietf.org/html/rfc5849#section-3
 *
 * @author      Craig Mason <craig.mason@stasismedia.com>
 * @package     OAuth
 * @subpackage  Request
 */
class Request implements RequestInterface
{
    /*
     * A number of parameters are USUALLY required, but when using PLAINTEXT
     * signature method, many can be excluded. 
     *
     * http://tools.ietf.org/html/rfc5849#section-3.1
     */

    /**
     * Required OAuth parameters for the request
     * @var array
     */
    private $_requiredOAuthParameters = array();

    /**
     * Optional OAuth parameters for the request
     * @var <type>
     */
    private $_optionalOAuthParameters = array();

    /**
     * Key/Value pairs of parameters
     * @var array
     */
    private $_parameters = array();

    /**
     * The HTTP Request method
     * @var string
     */
    private $_requestMethod = 'GET';

    /**
     * Adds the required and optional parameters for all requests
     */
    public function __construct()
    {
        // Required parameters
        $this->addRequiredOAuthParameters(array(
            'oauth_consumer_key',
            'oauth_signature_method'
        ));

        // Optional parameters
        $this->addOptionalOAuthParameters(array(
            'oauth_token',
            'oauth_version'
        ));
    }

    /**
     * Adds additional REQUIRED parameters to this request
     * @param array $parameters Additional required parameters
     */
    public function addRequiredOAuthParameters(array $parameters)
    {
        foreach($parameters as $parameter)
        {
            if(!in_array($parameter, $this->_requiredOAuthParameters))
            {
                $this->_requiredOAuthParameters[] = $parameter;
            }
        }
    }

    /**
     * Adds additional OPTIONAL parameters to this request
     * @param array $parameters Additional optional parameters
     */
    public function addOptionalOAuthParameters(array $parameters)
    {
        foreach($parameters as $parameter)
        {
            if(!in_array($parameter, $this->_optionalOAuthParameters))
            {
                $this->_optionalOAuthParameters[] = $parameter;
            }
        }
    }

    /**
     * Check if all of the required parameters are present
     * @return bool
     */
    public function hasRequiredParameters()
    {
        // Check if any required parameters are missing
        foreach($this->_requiredOAuthParameters as $requiredParameter)
        {
            if(!in_array($requiredParameter, $this->_parameters))
            {
                return false;
            }
        }

        return true;
    }

    /**
     * Adds the parameter and value to this request's parameters
     *
     * @param string $parameter
     * @param string $value
     */
    public function setParameter($parameter, $value)
    {
        array_merge($this->_parameters, array($parameter => $value));
    }

    /**
     * Sets an array of parameters
     * @param array $parameters
     */
    public function setParameters($parameters)
    {
        array_merge($this->_parameters, $parameters);
    }

    public function getParameters()
    {
        return $this->_parameters;
    }

    public function getBaseString()
    {
        
    }

}