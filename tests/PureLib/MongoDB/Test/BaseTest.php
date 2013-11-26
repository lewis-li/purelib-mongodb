<?php
namespace PureLib\MongoDB\Test;
use PureLib\MongoDB\DB;

abstract class BaseTest extends \PHPUnit_Framework_TestCase
{
	public static $client;
	public static $config;
	public $db;
	
	public static function setUpBeforeClass()
	{
		self::$client = new \PureLib\MongoDB\Client;
		
		self::$config = array(
				'defaultDBName' => Config::$defaultDBName,
				'defaultCollectionName' => Config::$defaultCollectionName,
		);
		
	}
	
	public static function tearDownAfterClass()
	{
		
	}
	
	protected function setUp()
	{
		//创建数据库
		$client = new \MongoClient;
		$client->selectDB(Config::$defaultDBName)->drop();
		
		$client->selectDB(Config::$defaultDBName)
			->selectCollection(Config::$defaultCollectionName)
			->insert(array('name'=>'tester'));
		
		$this->db = new DB(self::$client, Config::$defaultDBName);
	}
	
	protected function tearDown()
	{
		$client = new \MongoClient;
		$client->selectDB(Config::$defaultDBName)->drop();
	}
	
	protected function getDB()
	{
		return $this->db;
	}
}