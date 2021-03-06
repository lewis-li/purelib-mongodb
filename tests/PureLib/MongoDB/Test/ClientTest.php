<?php
namespace PureLib\MongoDB\Test;

class ClientTest extends BaseTest
{
	public function test__get()
	{
		$db = Config::$defaultDBName;
		$this->assertInstanceOf('PureLib\MongoDB\DB', self::$client->$db);
		
		try {
			$db = Config::$undefinedDBName;
			self::$client->$db;
		}catch (\MongoException $e)
		{
			return ;
		}
		$this->fail();
	}	
	
	public function testSelectDB()
	{
		$this->assertInstanceOf('PureLib\MongoDB\DB', self::$client->selectDB(Config::$defaultDBName));
		
		try {
			self::$client->selectDB(Config::$undefinedDBName);
		}catch (\MongoException $e)
		{
			return ;
		}
		$this->fail();
	}
	
	public function testNewDB()
	{
		$this->assertInstanceOf('PureLib\MongoDB\DB', self::$client->newDB(Config::$undefinedDBName));
		try {
			self::$client->newDB(Config::$defaultDBName);
		} catch (\MongoException $e)
		{
			return;
		}
		
		$this->fail();
		
	}
	
	public function testDropDB()
	{
		try {
			self::$client->dropDB(Config::$defaultDBName);
		} catch (\MongoException $e)
		{
			return;
		}
		$this->fail();
	}
	
	public function testSelectCollection()
	{
		$this->assertInstanceOf('MongoCollection', self::$client->selectCollection(Config::$defaultDBName, Config::$defaultCollectionName));
		
		try {
			self::$client->selectCollection(Config::$undefinedDBName, Config::$undefinedCollectionName);
			$this->fail();
		} catch (\MongoException $e)
		{
			
		}
		
		try {
			self::$client->selectCollection(Config::$defaultDBName, Config::$undefinedCollectionName);
			$this->fail();
		} catch (\MongoException $e)
		{
			
		}
	}
}