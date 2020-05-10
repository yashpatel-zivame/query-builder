# Clone of Laravel Eloquent Query Builder
> Just for learning purpose

## What select query looks like
```php
(new Database\QueryBuilder)->table('users')->get();
```

- Use of first method instead of get will give you the first
	row dependent up on rest of the conditions
```php
(new Database\QueryBuilder)->table('users')->first();
```

- In-order to count number of rows
```php
(new Database\QueryBuilder)->table('users')->count();
```

- Select specific columns only
```php
(new Database\QueryBuilder)->table('users')->select('first_name', 'last_name', 'email')->get();
```

- Filteration with where clause
```php
(new Database\QueryBuilder)->table('users')->where('first_name', 'Alexender')->get();
```

- Add more where conditions, and where
```php
(new Database\QueryBuilder)->table('users')
		->where('is_active', true)
		->where('created_at', '>=', 2019-12-01')
		->get();
```

- May be you want to use operater other than "Equals to" ('='), this is how you can
```php
(new Database\QueryBuilder)->table('users')->where('created_at', '>=', 2019-12-01')->get();
```

- Limit your query results
```php
(new Database\QueryBuilder)->table('users')->limit(20)->get();
```

- Order By
```php
(new Database\QueryBuilder)->table('users')->orderBy('name')->get();
```

- Also there is desc
```php
(new Database\QueryBuilder)->table('users')->orderBy('name', 'desc')->get();
```

- Order by multiple fields
```php
(new Database\QueryBuilder)->table('users')->orderBy('country_id')->orderBy('created_at', 'desc')->get();
```
