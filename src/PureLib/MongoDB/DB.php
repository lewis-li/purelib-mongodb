<?php
namespace PureLib\MongoDB;

class DB extends \MongoDB
{
	private $dbnames;
	private $isNewDatabase=false;
	
	/**
	 * 
	 * @param \MongoClient $connection
	 * @param string $database_name
	 * @return boolean
	 */
	public static function exists(\MongoClient $connection, $database_name)
	{
		$dbs = $connection->listDBs();
		
		foreach ($dbs['databases'] as $d)
		{
			if($database_name == $d['name'])
				return true;
		}
		return false;
	}
	
	/**
	 * 
	 * @param \MongoClient $connection
	 * @param string $database_name
	 * @throws \MongoException
	 * @return \PureLib\MongoDB\DB
	 */
	public static function newDB(\MongoClient $connection, $database_name)
	{
		if(self::exists($connection, $database_name))
		{
			throw new \MongoException('database '. $database_name . ' has exists.');
		}

		return new self($connection, $database_name, true);
	}
	
	/**
	 * 
	 * @param \MongoClient $connection
	 * @param string $database_name
	 * @throws \MongoException
	 * @return \PureLib\MongoDB\DB
	 */
	public static function select(\MongoClient $connection, $database_name)
	{
		if(self::exists($connection, $database_name) === false)
		{
			throw new \MongoException("db '$database_name' not found");
		}
		return new self($connection, $database_name);
	}
	
	/**
	 * 
	 * @param \MongoClient $connection
	 * @param string $database_name
	 * @param boolean $is_new_database
	 */
	public function __construct(\MongoClient $connection, $database_name, $is_new_database=false)
	{
		parent::__construct($connection, $database_name);
		$this->isNewDatabase = $is_new_database;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see MongoDB::__get()
	 */
	public function __get($collection_name)
	{
		if($this->existsCollection($collection_name)===false)
		{
			throw new \MongoException("collection '$collection_name' not found.");
		}
		return parent::__get($collection_name);
	}	
	
	/**
	 * 
	 * @param string $collection_name
	 * @return boolean
	 */
	public function existsCollection($collection_name)
	{
		$collections = $this->getCollectionNames();
		return in_array($collection_name, $collections);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see MongoDB::selectCollection()
	 */
	public function selectCollection($collection_name)
	{
		if($this->existsCollection($collection_name)===false)
		{
			throw new \MongoException("collection '$collection_name' not found.");
		}
		return parent::selectCollection($collection_name);
	}
}