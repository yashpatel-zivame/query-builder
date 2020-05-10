<?php

use Database\QueryBuilder;
use PHPUnit\Framework\TestCase;

declare(strict_types=1);

class DatabaseManageTests extends TestCase
{
	/** @test  */
	public function can_build_sql_statement()
	{
		$selectQuery = QueryBuilder::table('users')->get();

		$this->assertEquals($selectQuery, 'SELECT * FROM `users`');
	}
}
