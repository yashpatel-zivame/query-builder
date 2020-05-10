<?php

namespace Database;

use BadMethodCallException;

class DB
{
	protected static $allowedStaticMethods = ['table'];

	/**
	 * Gives QueryBuilder's instance
	 * @return \Database\QueryBuilder
	 */
	protected static function getQueryBuilder() {
		return new QueryBuilder;
	}

	/**
	 * It'll be responsilbe to handle undefined
	 * static methods
	 * @param  string $method
	 * @param  array $params
	 * @return mixed
	 */
	public static function __callStatic($method, $params) {
		if (! in_array(self::allowedStaticMethods, $method)) {
			throw new BadMethodCallException("Static method {$method} not found.");

		}

		return self::getQueryBuilder()->$method(...$params);
	}
}
