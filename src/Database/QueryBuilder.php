<?php

namespace Database;

class QueryBuilder
{
	protected $table;

	protected $columns = ['*'];

	protected $limit;

	/**
	 * sets table name to perform query
	 *
	 * @param  string $tableName
	 * @return \Database\QueryBuilder
	 */
	public function table($tableName)
	{
		$this->table = $tableName;

		return $this;
	}

	/**
	 * builds up select statement
	 *
	 * @return string
	 */
	public function get()
	{
		$limit = '';

		if ($this->limit) {
			$limit = " LIMIT {$this->limit}";
		}

		$columns = implode('`, `', $this->columns);

		return "SELECT `{$columns}` FROM `{$this->table}`{$limit}";
	}

	/**
	 * selects supplied columns only
	 *
	 * @param  array $columns
	 * @return \Database\QueryBuilder
	 */
	public function select(...$columns)
	{
		$this->columns = $columns;

		return $this;
	}

	public function limit($limit)
	{
		$this->limit = $limit;

		return $this;
	}
}
