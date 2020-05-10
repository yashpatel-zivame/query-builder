<?php

namespace Database;

use InvalidArgumentException;

class QueryBuilder
{
	/**
	 * name of the table
	 *
	 * @var string
	 */
	protected $table;

	/**
	 * columns to be retrived
	 *
	 * @var array
	 */
	protected $columns = ['*'];

	/**
	 * limit on query result
	 * @var integer
	 */
	protected $limit;

	/**
	 * column and the direction
	 * we want to order by
	 *
	 * @var array
	 */
	protected $orderBy = [];

	protected $wheres = [];

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

		$orderBy = '';

		if ($this->orderBy) {
			extract($this->orderBy);

			$direction = $direction ? " {$direction}" : '';

			$orderBy = " ORDER BY `{$column}`{$direction}";
		}

		$columns = implode('`, `', $this->columns);

		$where = '';

		if ($this->wheres) {
			$where = ' WHERE';

			foreach ($this->wheres as $i => $whereCond) {
				extract($whereCond);

				if ($i) {
					$where .= " {$conjuction}";
				}

				$where .= " `{$field}` {$operator} '{$value}'";
			}
		}

		return "SELECT `{$columns}` FROM `{$this->table}`{$where}{$orderBy}{$limit}";
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

	/**
	 * limit on query
	 *
	 * @param  integer $limit
	 * @return \Database\QueryBuilder
	 */
	public function limit($limit)
	{
		if (! is_numeric($limit) || (int) $limit < 0) {
			throw new InvalidArgumentException("a positive numeric value was expected");
		}

		$this->limit = $limit;

		return $this;
	}

	/**
	 * order by clause
	 * @param  string $column
	 * @return \Database\QueryBuilder
	 */
	public function orderBy($column, $direction = null)
	{
		$direction = strtoupper($direction);

		if (count(func_get_args()) === 2 && ! in_array($direction, ['ASC', 'DESC'])) {
			throw new InvalidArgumentException("Order by caluse supports only ASC & DESC");
		}

		$this->orderBy = compact('column', 'direction');

		return $this;
	}

	public function where($field, $operator, $value)
	{
		$conjuction = 'AND';

		$this->wheres[] = compact('field', 'operator', 'value', 'conjuction');

		return $this;
	}

	public function orWhere($field, $operator, $value)
	{
		$conjuction = 'OR';

		$this->wheres[] = compact('field', 'operator', 'value', 'conjuction');

		return $this;
	}
}
