<?php

namespace TijsVerkoyen\DBFact;

use SoapClient as BaseSoapClient;
use TijsVerkoyen\DBFact\Types\Message;

/**
 * DBFact class
 *
 * @author		Tijs Verkoyen <php-dbfact@verkoyen.eu>
 * @version		1.0.0
 * @copyright	Copyright (c) Tijs Verkoyen. All rights reserved.
 * @license		BSD License
 */
class DBFact extends BaseSoapClient
{
    const DEBUG = true;
    const VERSION = '1.0.0';

    /**
     * The soapclient
     *
     * @var BaseSoapClient
     */
    private $soapclient;

    /**
     * The timeout
     *
     * @var int
     */
    private $timeOut = 10;

    /**
     * The user agent
     *
     * @var string
     */
    private $userAgent;

    /**
     * The WSDL location
     *
     * @var string
     */
    private $wsdl;

    /**
     * @var array
     */
    private $classMaps = array();

    /**
     * Default constructor
     *
     * @param string[optional] $wsdl The location of the WSDL-file
     */
    public function __construct($wsdl)
    {
        if ($wsdl !== null) {
            $this->setWsdl($wsdl);
        }
    }

    /**
     * Convert the XML into an object
     *
     * @param  string $xml
     * @param  string $className
     * @return object
     */
    public static function convertToObject($xml, $className)
    {
        $response = new $className;
        $response->initialize($xml);

        return $response;
    }

    /**
     * Decode a response
     *
     * @param  mixed  $response
     * @return object
     */
    private function decodeResponse($response)
    {
        // soapfault?
        if ($response instanceof \SoapFault) {
            if (self::DEBUG) {
                var_dump($this);
            }

            throw new Exception($response->getMessage(), $response->getCode());
        }

        $positionOfFirstOpeningTag = strpos($response, '<', strpos($response, '<?') + 1) + 1;
        $positionOfFirstClosingTag = strpos($response, '>', $positionOfFirstOpeningTag);

        $className = 'TijsVerkoyen\\DBFact\\Types\\' . substr(
            $response,
            $positionOfFirstOpeningTag,
            ($positionOfFirstClosingTag - $positionOfFirstOpeningTag)
        );

        // convert into XML
        $xml = simplexml_load_string($response);

        $path = realpath(dirname(__FILE__) . '/../../' . str_replace('\\', '/', $className) . '.php');
        if (file_exists($path)) {
            return DBFact::convertToObject($xml, $className);
        } else {
            $response = $xml;

            // an error
            if ($response === false || isset($response->Error)) {
                if (self::DEBUG) {
                    var_dump($this);
                }

                $message = 'Invalid response.';
                if ($response !== false) {
                    $message = $response->Error;
                }

                throw new Exception($message);
            }
        }

        // return
        return $response;
    }

    /**
     * Decode a response that was zipped
     *
     * @param  string $response
     * @return object
     */
    private function decodeZipResponse($response)
    {
        $response = $this->decodeResponse($response);

        // an error
        if ($response === false || !isset($response->crs_answer->c_zipfile)) {
            if (self::DEBUG) {
                var_dump($this);
            }

            throw new Exception('Invalid response.');
        }

        // store content
        $filename = $timestamp = 'dbfact_' . uniqid();
        $file = tempnam(sys_get_temp_dir(), $filename);
        $handle = fopen($filename, 'a');
        fwrite($handle, base64_decode($response->crs_answer->c_zipfile));
        fclose($handle);

        // open the file as a zip
        $zip = zip_open($filename);

        if ($zip === false) {
            if (self::DEBUG) {
                var_dump($this);
            }

            throw new Exception('Invalid response.');
        }

        $entry = zip_read($zip);
        if (zip_entry_open($zip, $entry, 'r')) {
            $xml = zip_entry_read($entry, zip_entry_filesize($entry));

            // cleanup
            zip_entry_close($entry);
            zip_close($zip);

            // convert into XML
            $response = simplexml_load_string($xml);

            // an error
            if ($response === false || isset($response->Error)) {
                if (self::DEBUG) {
                    var_dump($this);
                }

                $message = 'Invalid response.';
                if ($response !== false) {
                    $message = $response->Error;
                }

                throw new Exception($message);
            }
        }

        // cleanup
        unlink($filename);

        // return
        return $response;
    }

    /**
     * Get the wsdl
     *
     * @return string
     */
    public function getWsdl()
    {
        return (string) $this->wsdl;
    }

    /**
     * Set the WSDL to use
     *
     * @param string $wsdl
     */
    public function setWsdl($wsdl)
    {
        $this->wsdl = $wsdl;
    }

    /**
     * Returns the SoapClient instance
     *
     * @return BaseSoapClient
     */
    public function getSoapClient()
    {
        // create the client if needed
        if (!$this->soapclient) {
            $options = array(
                'trace' => self::DEBUG,
                'exceptions' => false,
                'connection_timeout' => $this->getTimeout(),
                'user_agent' => $this->getUserAgent(),
                'cache_wsdl' => WSDL_CACHE_BOTH,
                'classmap' => $this->classMaps,
            );

            $this->soapClient = new \SoapClient($this->getWsdl(), $options);
        }

        return $this->soapClient;
    }

    /**
     * Get the timeout that will be used
     *
     * @return int
     */
    public function getTimeOut()
    {
        return (int) $this->timeOut;
    }

    /**
     * Set the timeout
     * After this time the request will stop. You should handle any errors triggered by this.
     *
     * @param int $seconds The timeout in seconds.
     */
    public function setTimeOut($seconds)
    {
        $this->timeOut = (int) $seconds;
    }

    /**
     * Get the user-agent that will be used.
     * Our version will be prepended to yours.
     * It will look like: "PHP DBFact/<version> <your-user-agent>"
     *
     * @return string
     */
    public function getUserAgent()
    {
        return (string) 'PHP DBFact/' . self::VERSION . ' ' . $this->userAgent;
    }

    /**
     * Set the user-agent for you application
     * It will be appended to ours, the result will look like:
     * "PHP DBFact/<version> <your-user-agent>"
     *
     * @param string $userAgent Your user-agent, it should look like <app-name>/<app-version>.
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = (string) $userAgent;
    }

    /**
     * @return string
     */
    public function showLocalPath()
    {
        return $this->getSoapClient()->ShowLocalPath();
    }

    /**
     * @return string
     */
    public function showFilePath()
    {
        return $this->getSoapClient()->ShowFilePath();
    }

    /**
     * @return string
     */
    public function showVersion()
    {
        return $this->getSoapClient()->ShowVersion();
    }

    /**
     * @return Message
     */
    public function showAllVersions()
    {
        $response = $this->getSoapClient()->ShowAllVersions();

        return $this->decodeResponse($response);
    }

    /**
     * @param  string $acSessionId
     * @param  string $acExtraPaswoord
     * @param  string $acWhere
     * @return array
     */
    public function artExport($acSessionId, $acExtraPaswoord, $acWhere)
    {
        $response = $this->getSoapClient()->ArtExport($acSessionId, $acExtraPaswoord, $acWhere);
        $response = $this->decodeZipResponse($response);

        $return = array();
        foreach ($response->Artikel as $item) {
            $return[] = DBFact::convertToObject($item, 'TijsVerkoyen\DBFact\Types\Artikel');
        }

        return $return;
    }

    /**
     * @param  string  $acLogin
     * @param  string  $acPassword
     * @return Message
     */
    public function login($acLogin, $acPassword)
    {
        $response = $this->getSoapClient()->Login($acLogin, $acPassword);

        return $this->decodeResponse($response);
    }
}
