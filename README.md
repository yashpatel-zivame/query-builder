# Clone of Laravel Eloquent Query Builder
> Just for learning purpose

## What select query looks like
```php (new Database\QueryBuilder)->table('users')->get(); ```
```php (new Database\QueryBuilder)->table('users')->select('first_name', 'last_name', 'email')->get(); ```
```php (new Database\QueryBuilder)->table('users')->limit(20)->get(); ```
