<?php
require_once(realpath(dirname(__FILE__) . "/../config/config.php"));
require_once(realpath(dirname(__FILE__) . "/MySqlClient.php"));

class BlugDbClient
{
	private $client;
	
	// Expects a map with entries:
	//   dbname
	//   host
	//   username
	//   password
	public function __construct()
	{
		global $config;
		$this->client = new MySqlClient($config["db"]);
	}
	
	public function insertUser($name)
	{
		$rows = $this->client->executeQuery(
			"CALL b_insertUser(
				@_name := $name
			);"
		);
	}
	
	public function deleteUser($id)
	{
		return $this->client->executeQuery(
			"CALL b_deleteUser(@_id := $id);"
			);
	}
	
	
	
	public function insertCategory($userId, $name, $description)
	{
		$rows = $this->client->executeQuery(
			"CALL b_insertCategory(
				@_user_id := $userId,
				@_name := $name,
				@_description := $description
			);"
		);
		
		return $rows[0]["id"];
	}
	
	public function getCategory($id, $userId)
	{
		$rows = $this->client->executeQuery(
			"CALL b_getCategory(
				@_id := $id,
				@_user_id := $userId
			);"
		);
		
		$items = [];
		
		foreach ($rows as $row)
		{
			$items[] = array(
				"id" => $row["id"],
				"user_id" => $row["user_id"],
				"name" => $row["name"],
				"description" => $row["description"],
				"when_created" => $row["when_created"],
				"when_updated" => $row["when_updated"]
			);
		}
		
		return $items;
	}
	
	public function updateCategory($id, $name, $description)
	{
		$this->client->executeQuery(
			"CALL b_updateCategory(
				@_id := $id,
				@_name := $name,
				@_description := $description
			);"
		);
	}
	
	public function deleteCategory($id)
	{
		return $this->client->executeQuery(
			"CALL b_deleteCategory(@_id := $id);"
			);
	}
	
	
	
	public function insertEntry($userId, $title, $content, $categoryId)
	{
		$rows = $this->client->executeQuery(
			"CALL b_insertEntry(
				@_user_id := $userId,
				@_title := $title,
				@_content := $content,
				@_category_id := $categoryId
			);"
		);
		
		return $rows[0]["id"];
	}
	
	public function getEntry($id, $categoryId, $title, $userId, $offset, $limit)
	{
		$rows = $this->client->executeQuery(
			"CALL b_getEntry(
				@_id := $id,
				@_category_id := $category_id,
				@_title := $title,
				@_user_id := $userId,
				@_offset bigint := $offset, 
				@_limit bigint := $limit
			);"
		);
		
		$items = [];
		
		foreach ($rows as $row)
		{
			$items[] = array(
				"id" => $row["id"],
				"user_id" => $row["user_id"],
				"title" => $row["title"],
				"content" => $row["content"],
				"category_id" => $row["category_id"],
				"when_created" => $row["when_created"],
				"when_updated" => $row["when_updated"]
			);
		}
		
		return $items;
	}
	
	public function updateEntry($id, $title, $content, $category_id)
	{
		$this->client->executeQuery(
			"CALL b_updateEntry(
				@_id := $id,
				@_title := $title,
				@_content := $content,
				@_category := $categoryId
			);"
		);
	}
	
	public function deleteEntry($id)
	{
		return $this->client->executeQuery(
			"CALL b_deleteEntry(@_id := $id);"
			);
	}
	
}
?>