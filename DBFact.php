<?php

namespace TijsVerkoyen\DBFact;

use SoapClient as BaseSoapClient;
use TijsVerkoyen\DBFact\Types\Message;

/**
 * DBFact class
 *
 * @author    Tijs Verkoyen <php-dbfact@verkoyen.eu>
 *
 * @version   1.0.0
 *
 * @copyright Copyright (c) Tijs Verkoyen. All rights reserved.
 * @license   BSD License
 */
class DBFact extends BaseSoapClient
{
    const DEBUG = false;
    const VERSION = '1.0.2';

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
    private $timeOut = 30;

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
    private $classMaps = [];

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
     *
     * @return object
     */
    public static function convertToObject($xml, $className)
    {
        $response = new $className();
        $response->initialize($xml);

        return $response;
    }

    /**
     * Decode a response
     *
     * @param  mixed  $response
     *
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
            return self::convertToObject($xml, $className);
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
     *
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
        $filename = tempnam(sys_get_temp_dir(), $filename);
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
            $options = [
                'trace' => self::DEBUG,
                'exceptions' => false,
                'connection_timeout' => $this->getTimeout(),
                'user_agent' => $this->getUserAgent(),
                'cache_wsdl' => WSDL_CACHE_BOTH,
                'classmap' => $this->classMaps,
            ];

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
     *
     * @return array
     */
    public function artExport($acSessionId, $acExtraPaswoord, $acWhere)
    {
        $response = $this->getSoapClient()->ArtExport($acSessionId, $acExtraPaswoord, $acWhere);
        $response = $this->decodeZipResponse($response);

        $return = [];
        foreach ($response->Artikel as $item) {
            $return[] = self::convertToObject($item, 'TijsVerkoyen\DBFact\Types\Artikel');
        }

        return $return;
    }

    /**
     * @param  string  $acLogin
     * @param  string  $acPassword
     *
     * @return Message
     */
    public function login($acLogin, $acPassword)
    {
        $response = $this->getSoapClient()->Login($acLogin, $acPassword);

        return $this->decodeResponse($response);
    }

    /**
     * @param  string                           $acSessionId
     * @param  array                            $acXmlMetImageIds
     *
     * @return TijsVerkoyen\DBFact\Types\Images
     */
    public function getArtImage($acSessionId, array $imageIds)
    {
        $acXmlMetImageIds = '<?xml version="1.0" encoding="utf-8"?>'."\n";
        $acXmlMetImageIds .= '<Message>'."\n";

        foreach ($imageIds as $id) {
            $acXmlMetImageIds .= '<ImageId>'. $id . '</ImageId>'."\n";
        }

        $acXmlMetImageIds .= '</Message>';

        $response = $this->getSoapClient()->GetArtImage($acSessionId, $acXmlMetImageIds);
        $response = $this->decodeZipResponse($response);

        return self::convertToObject($response, 'TijsVerkoyen\DBFact\Types\Images');
    }

    /**
     * @param $acSessionId
     * @param  array                             $artNummers
     * @param  null                              $anRelnum
     *
     * @return TijsVerkoyen\DBFact\Types\Message
     */
    public function getMultipleArtInfo($acSessionId, array $artNummers = null, $anRelnum = null)
    {
        $acXmlMetArtCodes = '<?xml version="1.0" encoding="utf-8"?>'."\n";
        $acXmlMetArtCodes .= '<Message>'."\n";

        foreach ($artNummers as $id) {
            $acXmlMetArtCodes .= '<ArtCode>'. $id . '</ArtCode>'."\n";
        }

        $acXmlMetArtCodes .= '</Message>';

        $response = $this->getSoapClient()->GetMultipleArtInfo($acSessionId, $acXmlMetArtCodes, $anRelnum);

        return $this->decodeResponse($response);
    }

    /**
     * @param $acSessionId
     * @param $acExtraPaswoord
     * @param $acWhere
     *
     * @return array
     */
    public function ladresExport($acSessionId, $acExtraPaswoord, $acWhere)
    {
        $response = $this->getSoapClient()->LadresExport($acSessionId, $acExtraPaswoord, $acWhere);
        $response = $this->decodeZipResponse($response);

        $return = [];
        foreach ($response->crs_ladres as $item) {
            $return[] = self::convertToObject($item, 'TijsVerkoyen\DBFact\Types\Ladres');
        }

        return $return;
    }

    /**
     * @param $acSessionId
     * @param  array                                $appendixIds
     *
     * @return TijsVerkoyen\DBFact\Types\Appendices
     */
    public function getAppendices($acSessionId, array $appendixIds)
    {
        $acXmlMetAppendixIds = '<?xml version="1.0" encoding="utf-8"?>'."\n";
        $acXmlMetAppendixIds .= '<Message>'."\n";

        foreach ($appendixIds as $id) {
            $acXmlMetAppendixIds .= '<Appendix>'. $id . '</Appendix>'."\n";
        }

        $acXmlMetAppendixIds .= '</Message>';

        $response = $this->getSoapClient()->GetAppendices($acSessionId, $acXmlMetAppendixIds);

        return $this->decodeResponse($response);
    }

    /**
     * @param $acSessionId
     * @param  array[optional]                      $appendixIds
     * @param  array[optional]                      $fullpaths
     *
     * @return TijsVerkoyen\DBFact\Types\Appendices
     */
    public function getAppendicesGezipt($acSessionId, array $appendixIds = null, array $fullPaths = null)
    {
        if (!empty($appendixIds) && !empty($fullpaths)) {
            throw new Exception('You can\'t specify ids and paths.');
        }

        if (!empty($appendixIds)) {
            $acXmlMetAppendixIds = '<?xml version="1.0" encoding="utf-8"?>'."\n";
            $acXmlMetAppendixIds .= '<Message>'."\n";

            foreach ($appendixIds as $id) {
                $acXmlMetAppendixIds .= '<Appendix>'. $id . '</Appendix>'."\n";
            }

            $acXmlMetAppendixIds .= '</Message>';
        }

        if (!empty($fullPaths)) {
            $acXmlMetAppendixIds = '<?xml version="1.0" encoding="utf-8"?>'."\n";
            $acXmlMetAppendixIds .= '<Message>'."\n";

            foreach ($fullPaths as $path) {
                $acXmlMetAppendixIds .= '<FullPath><![CDATA['. $path . ']]></FullPath>'."\n";
            }

            $acXmlMetAppendixIds .= '</Message>';
        }

        $response = $this->getSoapClient()->GetAppendicesGezipt($acSessionId, $acXmlMetAppendixIds);
        $response = $this->decodeZipResponse($response);

        return self::convertToObject($response, 'TijsVerkoyen\DBFact\Types\Appendices');
    }

    /**
     * @param $acSessionId
     *
     * @return TijsVerkoyen\DBFact\Types\Message
     */
    public function keepAlive($acSessionId)
    {
        $response = $this->getSoapClient()->KeepAlive($acSessionId);

        return $this->decodeResponse($response);
    }

    /**
     * @param  array            $files
     * @param  string[optional] $dossier
     *
     * @return bool
     */
    public function receiveFile(array $files, $dossier = null)
    {
        $acXMLWithFiles = '<?xml version="1.0" encoding="utf-8"?>'."\n";
        $acXMLWithFiles .= '<Message>'."\n";

        foreach ($files as $file) {
            $acXMLWithFiles .= '<FileName>'. $file['FileName'] . '</FileName>'."\n";
            $acXMLWithFiles .= '<File>'. $file['File'] . '</File>'."\n";

            if (isset($file['Dossier'])) {
                $acXMLWithFiles .= '<File>'. $file['Dossier'] . '</Dossier>'."\n";
            }
        }

        if ($dossier != null) {
            $acXMLWithFiles .= '<Dossier>' . $dossier . '</Dossier>'."\n";
        }

        $acXMLWithFiles .= '</Message>';

        return $this->getSoapClient()->ReceiveFile($acXMLWithFiles);
    }

    /**
     * @param  array                             $files
     * @param  string[optional]                  $dossier
     *
     * @return TijsVerkoyen\DBFact\Types\Message
     */
    public function receiveFileWithComment(array $files, $dossier = null)
    {
        $acXMLWithFiles = '<?xml version="1.0" encoding="utf-8"?>'."\n";
        $acXMLWithFiles .= '<Message>'."\n";

        foreach ($files as $file) {
            $acXMLWithFiles .= '<FileName>'. $file['FileName'] . '</FileName>'."\n";
            $acXMLWithFiles .= '<File>'. $file['File'] . '</File>'."\n";

            if (isset($file['Dossier'])) {
                $acXMLWithFiles .= '<File>'. $file['Dossier'] . '</Dossier>'."\n";
            }
        }

        if ($dossier != null) {
            $acXMLWithFiles .= '<Dossier>' . $dossier . '</Dossier>'."\n";
        }

        $acXMLWithFiles .= '</Message>';

        $response = $this->getSoapClient()->ReceiveFileWithComment($acXMLWithFiles);

        return $this->decodeResponse($response);
    }

    /**
     * @param $acSessionId
     * @param $acExtraPaswoord
     * @param $acWhere
     *
     * @return array
     */
    public function relExport($acSessionId, $acExtraPaswoord, $acWhere)
    {
        $response = $this->getSoapClient()->RelExport($acSessionId, $acExtraPaswoord, $acWhere);
        $response = $this->decodeZipResponse($response);

        $return = [];
        foreach ($response->Relatie as $item) {
            $return[] = self::convertToObject($item, 'TijsVerkoyen\DBFact\Types\Relatie');
        }

        return $return;
    }

    /**
     * @param $acSessionId
     * @param $anRelNum
     * @param $anTransId
     * @param $anBedrag
     * @param $anValuta
     * @param $adDatum
     *
     * @return mixed
     */
    public function transportFeeExtended($acSessionId, $anRelNum, $anTransId, $anBedrag, $anValuta, $adDatum)
    {
        $response = $this->getSoapClient()->TransportFeeExtended(
            $acSessionId,
            $anRelNum,
            $anTransId,
            $anBedrag,
            $anValuta,
            $adDatum
        );
        $response = $this->decodeResponse($response);

        return $response;
    }

    /**
     * @param $acSessionId
     * @param $acArtNummer
     * @param $anRelnum
     *
     * @return object
     */
    public function getArtInfo($acSessionId, $acArtNummer, $anRelnum)
    {
        $response = $this->getSoapClient()->GetArtInfo($acSessionId, $acArtNummer, $anRelnum);
        $response = $this->decodeResponse($response);

        return $response;
    }

    /**
     * @param $acSessionId
     * @param $acExtraPaswoord
     * @param $acWhere
     *
     * @return object
     */
    public function facCreExport($acSessionId, $acExtraPaswoord, $acWhere)
    {
        $response = $this->getSoapClient()->FacCreExport($acSessionId, $acExtraPaswoord, $acWhere);
        $response = $this->decodeResponse($response);

        return $response;
    }

    /**
     * @param $acSessionId
     * @param $acExtraPaswoord
     * @param $acWhere
     *
     * @return object
     */
    public function srvExport($acSessionId, $acExtraPaswoord, $acWhere)
    {
        $response = $this->getSoapClient()->SrvExport($acSessionId, $acExtraPaswoord, $acWhere);
        $response = $this->decodeResponse($response);

        return $response;
    }

    /**
     * @param $acSessionId
     * @param $acExtraPaswoord
     * @param $acWhere
     *
     * @return object
     */
    public function bbkExport($acSessionId, $acExtraPaswoord, $acWhere)
    {
        $response = $this->getSoapClient()->BBKExport($acSessionId, $acExtraPaswoord, $acWhere);
        $response = $this->decodeResponse($response);

        return $response;
    }

    /**
     * @param $acSessionId
     * @param $acExtraPassword
     * @param $acWhere
     *
     * @return object
     */
    public function boklExport($acSessionId, $acExtraPassword, $acWhere)
    {
        $response = $this->getSoapClient()->BOKlExport($acSessionId, $acExtraPassword, $acWhere);
        $response = $this->decodeResponse($response);

        return $response;
    }

    /**
     * @param $acSessionId
     * @param $acExtraPaswoord
     * @param $acWhere
     *
     * @return object
     */
    public function turnOverExport($acSessionId, $acExtraPaswoord, $acWhere)
    {
        $response = $this->getSoapClient()->TurnOverExport($acSessionId, $acExtraPaswoord, $acWhere);
        $response = $this->decodeResponse($response);

        return $response;
    }
}
