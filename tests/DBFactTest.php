<?php

require_once '../../../autoload.php';
require_once 'config.php';
require_once 'PHPUnit/Framework/TestCase.php';

use \TijsVerkoyen\DBFact\DBFact;

/**
 * test case.
 */
class DBFactTest extends PHPUnit_Framework_TestCase
{
    /**
     * DBFact instance
     *
     * @var	DBFact
     */
    private $dbFact;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->dbFact = new DBFact(WSDL);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->dbFact = null;
        parent::tearDown();
    }

    /**
     * Check if an item is an Article
     *
     * @param $item
     */
    private function isArticle($item)
    {
        $this->assertInstanceOf('TijsVerkoyen\DBFact\Types\Article', $item);
    }

    /**
     * Check if an item is an Artikel
     *
     * @param $item
     */
    private function isArtikel($item)
    {
        $this->assertInstanceOf('\TijsVerkoyen\DBFact\Types\Artikel', $item);
    }

    /**
     * Check if an item is an Image.
     * @param $item
     */
    private function isImage($item)
    {
        $this->assertInstanceOf('\TijsVerkoyen\DBFact\Types\Image', $item);
    }

    /**
     * Check if an item is a Message
     * @param $item
     */
    private function isMessage($item)
    {
        $this->assertInstanceOf('\TijsVerkoyen\DBFact\Types\Message', $item);
    }

    /**
     * Tests DBFact->getTimeOut()
     */
    public function testGetTimeOut()
    {
        $this->dbFact->setTimeOut(5);
        $this->assertEquals(5, $this->dbFact->getTimeOut());
    }

    /**
     * Tests DBFact->getUserAgent()
     */
    public function testGetUserAgent()
    {
        $this->dbFact->setUserAgent('testing/1.0.0');
        $this->assertEquals(
            'PHP DBFact/' . DBFact::VERSION . ' testing/1.0.0',
            $this->dbFact->getUserAgent()
        );
    }

    /**
     * Tests DBFact->showFilePath()
     */
    public function testShowFilePath()
    {
        $response = $this->dbFact->showFilePath();
        $this->assertInternalType('string', $response);
    }

    /**
     * Tests DBFact->showLocalPath()
     */
    public function testShowLocalPath()
    {
        $response = $this->dbFact->showLocalPath();
        $this->assertInternalType('string', $response);
    }

    /**
     * Tests DBFact->showVersion()
     */
    public function testShowVersion()
    {
        $response = $this->dbFact->showVersion();
        $this->assertInternalType('string', $response);
    }

    /**
     * Tests DBFact->login()
     */
    public function testLogin()
    {
        $response = $this->dbFact->login(LOGIN, PASSWORD);
        $this->isMessage($response);
    }

    /**
     * Tests DBFact->artExport()
     */
    public function testArtExport()
    {
        $response = $this->dbFact->login(LOGIN, PASSWORD);
        $response = $this->dbFact->artExport($response->SessionId, EXTRA_PASSWORD, '');
        $this->assertInternalType('array', $response);
        foreach ($response as $item) {
            $this->isArtikel($item);
        }
    }

    /**
     * Tests DBFact->getArtImage()
     */
    public function testGetArtImage()
    {
        $response = $this->dbFact->login(LOGIN, PASSWORD);
        $response = $this->dbFact->getArtImage($response->SessionId, array(119, 120));
        $this->assertInstanceOf('TijsVerkoyen\DBFact\Types\Images', $response);
        foreach ($response->Image as $item) {
            $this->isImage($item);
        }
    }

    /**
     * Tests DBFact->getMultipleArtInfo()
     */
    public function testGetMultipleArtInfo()
    {
        $response = $this->dbFact->login(LOGIN, PASSWORD);
        $response = $this->dbFact->getMultipleArtInfo($response->SessionId, array(2, 3), 1);
        $this->assertInstanceOf('TijsVerkoyen\DBFact\Types\Message', $response);
        foreach ($response->Article as $item) {
            $this->isArticle($item);
        }
    }
}
