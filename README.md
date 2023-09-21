<h2>Setup</h2>
<ul>
    <li>copy the .env.example file to a .env file.</li>
    <li>composer install.</li>
    <li>npm install.</li>
    <li>artisan migrate:fresh --seed.</li>
    <li>login with one of the users email address from the database (default-password: password).</li>
</ul>

<h2>Details</h2>

the post model has a global scope to only return posts for the first user.
```
protected static function booted(): void
    {
        static::addGlobalScope('first_user', function (Builder $builder) {
            $builder->where('user_id', 1);
        });
    }
```

i have added the following code to the list page on the Post Resource to ignore the global scope.
```
public function table(Table $table): Table
    {
        return $table->modifyQueryUsing(fn (Builder $query) => $query->withoutGlobalScopes());
    }
```

<h2>The Problem</h2>
<p>
    when navigating to the posts list page via the nav, the view seems to have recieved the records from the database (noted that the pagination shows the correct record count) but does not generate the table view.
</p>
