# Example wp-cli Plugin

This plugin can be added to a Wordpress site, and will provide a `wp auditor audit` command. This simply takes the prefix of the table, and whatever is passed as an arg, and attempt to report information on the table. For example, running `wp auditor audit posts` will yield output like this:

```
www-data@b8414984f0aa:/app$ wp auditor audit posts
Auditing data...
567 rows in posts table. 
Success: Audit successful
```

Take a look at the `auditor.php` to see what is done to make this happen. From a high level:
- Define an `auditor` class
- Add a `wp-cli` command which invokes the `auditor` class and uses the argument passed in.
