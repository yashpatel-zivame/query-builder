<?php

declare(strict_types=1);

use Database\QueryBuilder;
use InvalidArgumentException;
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
	public function it_can_select_first()
	{
		$sql = (new QueryBuilder)->table('users')->first();

		$this->assertEquals($sql, 'SELECT `*` FROM `users` LIMIT 1');
	}

	/** @test  */
	public function it_can_count_rows()
	{
		$sql = (new QueryBuilder)->table('users')->count();

		$this->assertEquals($sql, 'SELECT count(*) FROM `users`');
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
	public function it_throws_exception_invalid_limit_passed()
	{
		$this->expectException(InvalidArgumentException::class);

		(new QueryBuilder)->table('users')->limit('NON_NUMERIC')->get();
	}

	/** @test  */
	public function it_throws_exception_when_negative_limit_passed()
	{
		$this->expectException(InvalidArgumentException::class);

		(new QueryBuilder)->table('users')->limit('-10')->get();
	}

	/** @test  */
	public function it_can_select_order_by()
	{
		$sql = (new QueryBuilder)->table('users')->orderBy('name')->get();

		$this->assertEquals($sql, 'SELECT `*` FROM `users` ORDER BY `name`');
	}

	/** @test  */
	public function it_can_select_multiple_order_by()
	{
		$sql = (new QueryBuilder)->table('users')->orderBy('name')->orderBy('created_at', 'DESC')->get();

		$this->assertEquals($sql, 'SELECT `*` FROM `users` ORDER BY `name`, `created_at` DESC');
	}

	/** @test  */
	public function it_can_select_order_by_desc()
	{
		$sql = (new QueryBuilder)->table('users')->orderBy('name', 'DESC')->get();

		$this->assertEquals($sql, 'SELECT `*` FROM `users` ORDER BY `name` DESC');
	}

	/** @test  */
	public function it_throws_exception_invalid_order_by_direction_supplied()
	{
		$this->expectException(InvalidArgumentException::class);

		(new QueryBuilder)->table('users')->orderBy('name', 'SOMETHING_ELSE')->get();
	}

	/** @test  */
	public function it_can_filter_through_where_caluse()
	{
		$sql = (new QueryBuilder)->table('users')->where('name', '=', 'Jhon Doe')->get();

		$this->assertEquals($sql, "SELECT `*` FROM `users` WHERE `name` = 'Jhon Doe'");
	}

	/** @test  */
	public function it_assumes_euqal_comparission_if_not_supplied()
	{
		$sql = (new QueryBuilder)->table('users')->where('name', 'Jhon Doe')->get();
		$sql = (new QueryBuilder)->table('users')->where('name', 'Jhon Doe')->orWhere('name', 'Alexender')->get();

		$this->assertEquals($sql, "SELECT `*` FROM `users` WHERE `name` = 'Jhon Doe' OR `name` = 'Alexender'");
	}

	/** @test  */
	public function it_can_apply_multiple_filters()
	{
		$sql = (new QueryBuilder)
			->table('users')
			->where('name', '=', 'Jhon Doe')
			->where('created_at', '>=', '2019-10-12 10:00:00')
			->get();

		$this->assertEquals($sql, "SELECT `*` FROM `users` WHERE `name` = 'Jhon Doe' AND `created_at` >= '2019-10-12 10:00:00'");
	}

	/** @test  */
	public function it_can_apply_or_where_clause()
	{
		$sql = (new QueryBuilder)
			->table('users')
			->where('name', '=', 'Jhon Doe')
			->orWhere('email', '=', 'test@database.com')
			->get();

		$this->assertEquals($sql, "SELECT `*` FROM `users` WHERE `name` = 'Jhon Doe' OR `email` = 'test@database.com'");
	}

	/** @test  */
	public function it_can_apply_multiple_or_where_clause()
	{
		$sql = (new QueryBuilder)
			->table('users')
			->where('name', '=', 'Jhon Doe')
			->orWhere('email', '=', 'test@database.com')
			->orWhere('is_active', '=', true)
			->get();

		$this->assertEquals($sql, "SELECT `*` FROM `users` WHERE `name` = 'Jhon Doe' OR `email` = 'test@database.com' OR `is_active` = 1");
	}

	/** @test  */
	public function it_can_select_specific_columns_as_well_as_limit_on_it()
	{
		$sql = (new QueryBuilder)->table('users')->select('name', 'email')->limit(10)->get();

		$this->assertEquals($sql, 'SELECT `name`, `email` FROM `users` LIMIT 10');
	}

	/** @test  */
	public function it_can_select_sepcific_columns_with_limits_and_order_by()
	{
		$sql = (new QueryBuilder)->table('users')->select('name', 'email')->orderBy('name')->limit(10)->get();

		$this->assertEquals($sql, 'SELECT `name`, `email` FROM `users` ORDER BY `name` LIMIT 10');
	}
}
