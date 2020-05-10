<?php

use Database\DB;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
	/** @test  */
	public function it_allows_instance_methods_to_be_called_statically()
	{
		$sql = DB::table('users')->where('is_active', true)->get();

		$this->assertEquals($sql, 'SELECT `*` FROM `users` WHERE `is_active` = 1');
	}
}
