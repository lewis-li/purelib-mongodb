<?php
namespace PureLib\MongoDB\Test;

use PureLib\MongoDB\DB;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1
 */
class DBTest extends BaseTest
{
    /**
     * @covers PureLib\MongoDB\DB::exists
     */
    public function testExists()
    {
    	$this->assertTrue(DB::exists(self::$client, Config::$defaultDBName));
    	$this->assertFalse(DB::exists(self::$client, Config::$undefinedDBName));
    }

    /**
     * @covers PureLib\MongoDB\DB::newDB
     */
    public function testNewDB()
    {
    	$this->assertInstanceOf('PureLib\MongoDB\DB', DB::newDB(self::$client, 'undefined_db'));
    	try {
    		DB::newDB(self::$client, self::$config['defaultDBName']);
    		$this->fail();
    	} catch (\MongoException $e)
    	{
    		
    	}
    }

    /**
     * @covers PureLib\MongoDB\DB::select
     */
    public function testSelect()
    {
    	$this->assertInstanceOf('PureLib\MongoDB\DB', DB::select(self::$client, self::$config['defaultDBName']));
    	try {
    		DB::select(self::$client, 'undefined_db');
    		$this->fail();
    	} catch (\MongoException $e)
    	{
    	
    	}
    }

    /**
     * @covers PureLib\MongoDB\DB::__get
     */
    public function test__get()
    {
    	$dbName = self::$config['defaultDBName'];
    	$db = new DB(self::$client, $dbName);
    	$collectionName = self::$config['defaultCollectionName'];
    	$this->assertInstanceOf('MongoCollection', $db->$collectionName);
    	try {
    		$collectionName = 'undefined_db';
    		$db->$collectionName;
    		$this->fail();
    	} catch (\MongoException $e)
    	{
    		 
    	}
    }

    /**
     * @covers PureLib\MongoDB\DB::existsCollection
     */
    public function testExistsCollection()
    {
    	$this->assertTrue($this->getDB()->existsCollection(self::$config['defaultCollectionName']));
    	$this->assertFalse($this->getDB()->existsCollection('undefined_collection'));
    }

    /**
     * @covers PureLib\MongoDB\DB::selectCollection
     */
    public function testSelectCollection()
    {
    	$this->assertInstanceOf('MongoCollection', $this->getDB()->selectCollection(self::$config['defaultCollectionName']));
    	try {
    		$this->getDB()->selectCollection('undefined_collection');
    		$this->fail();
    	} catch (\MongoException $e)
    	{
    		
    	}
    }
}
