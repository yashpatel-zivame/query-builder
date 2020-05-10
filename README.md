# Clone of Laravel Eloquent Query Builder
> Just for learning purpose

## What select query looks like
```(new Database\QueryBuilder)->table('users')->get(); ``` <br>
```(new Database\QueryBuilder)->table('users')->select('first_name', 'last_name', 'email')->get(); ``` <br>
```(new Database\QueryBuilder)->table('users')->limit(20)->get(); ``` <br>
