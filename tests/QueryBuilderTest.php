<?php

declare(strict_types=1);

use Database\QueryBuilder;
use PHPUnit\Framework\TestCase;

class DatabaseManageTests extends TestCase
{
	/** @test  */
	public function it_can_build_sql_statement()
	{
		$selectQuery = (new QueryBuilder)->table('users')->get();

		$this->assertEquals($selectQuery, 'SELECT `*` FROM `users`');
	}

	/** @test  */
	public function it_can_select_on_specific_columns()
	{
		$selectSpecificColumns = (new QueryBuilder)->table('users')->select('name', 'email')->get();

		$this->assertEquals($selectSpecificColumns, 'SELECT `name`, `email` FROM `users`');
	}

	/** @test  */
	public function it_can_limit_on_the_results()
	{
		$limitQuery = (new QueryBuilder)->table('users')->limit(10)->get();

		$this->assertEquals($limitQuery, 'SELECT `*` FROM `users` LIMIT 10');
	}
}
