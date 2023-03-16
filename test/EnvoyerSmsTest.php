<?php
namespace SpotHit\Client;


use DevCoder\DotEnv;
use SpotHit\Client\Api\SmsApi;
use SpotHit\Client\Exception\SmsApiException;
use SpotHit\Client\Model\SmsMessage;

/**
 * AccountApiTest Class Doc Comment
 *
 * @category Class
 * @package  SpotHit\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class EnvoyerSmsTest extends \PHPUnit_Framework_TestCase
{
    #region key
    private static $apiKey  = '***';
    #endregion
    /**
     * Setup before running any test cases
     */
    public static function setUpBeforeClass()
    {
        (new DotEnv(__DIR__ . '\\..\\.env.local'))->load();
        self::$apiKey = getenv("API_KEY");
    }

    /**
     * Setup before running each test case
     */
    public function setUp()
    {

    }

    /**
     * Clean up after running each test case
     */
    public function tearDown()
    {
    }

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass()
    {
    }

    /**
     * Test case for getAccount
     *
     * Get your account information, plan and credits details.
     *
     */
    public function testValid()
    {
        $api = new SmsApi();
        $sms = new SmsMessage();
        $sms->setKey(self::$apiKey)->setMessage("Bonjour")->setDestinataires([getenv("PHONE_NUMBER_TESTER")]);
        $api->envoyer($sms);
        $this->assertTrue($resp->getStatusCode() == "200");
    }

    public function testNumeroDeFixeInvalid()
    {
        $api = new SmsApi();
        $sms = new SmsMessage();
        try {
            $sms->setKey(self::$apiKey)->setMessage("Bonsoir !")->setDestinataires(['25689','']);
            $resp = $api->envoyer($sms);
        }catch(\Exception $o_O){
            $this->assertTrue(true);
        }
    }
}