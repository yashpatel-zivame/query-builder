<?php

namespace Database;

class DB
{
	protected static $allowedStaticMethods = ['table'];

	public static function getQueryBuilder() {
		return new QueryBuilder;
	}

	public static function __callStatic($method, $params) {
		return self::getQueryBuilder()->$method(...$params);
	}
}
