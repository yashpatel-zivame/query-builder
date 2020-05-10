# Clone of Laravel Eloquent Query Builder
> Just for learning purpose

## What select query looks like
```php (new Database\QueryBuilder)->table('users')->get(); ``` <br>
```php (new Database\QueryBuilder)->table('users')->select('first_name', 'last_name', 'email')->get(); ``` <br>
```php (new Database\QueryBuilder)->table('users')->limit(20)->get(); ``` <br>
