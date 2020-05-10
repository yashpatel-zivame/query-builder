<?php

declare(strict_types=1);

use Database\QueryBuilder;
use PHPUnit\Framework\TestCase;

class DatabaseManageTests extends TestCase
{
	/** @test  */
	public function it_can_build_sql_statement()
	{
		$sql = (new QueryBuilder)->table('users')->get();

		$this->assertEquals($sql, 'SELECT `*` FROM `users`');
	}

	/** @test  */
	public function it_can_select_on_specific_columns()
	{
		$sql = (new QueryBuilder)->table('users')->select('name', 'email')->get();

		$this->assertEquals($sql, 'SELECT `name`, `email` FROM `users`');
	}

	/** @test  */
	public function it_can_limit_on_the_results()
	{
		$sql = (new QueryBuilder)->table('users')->limit(10)->get();

		$this->assertEquals($sql, 'SELECT `*` FROM `users` LIMIT 10');
	}

	/** @test  */
	public function it_can_select_specific_columns_as_well_as_limit_on_it()
	{
		$sql = (new QueryBuilder)->table('users')->select('name', 'email')->limit(10)->get();

		$this->assertEquals($sql, 'SELECT `name`, `email` FROM `users` LIMIT 10');
	}
}
