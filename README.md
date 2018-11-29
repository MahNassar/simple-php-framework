# native-php-blog

php mvc framework with simple blog example
tools :- php7.1, composer, phpunit, mysql, docker

### installation guide :- 

```sudo docker-compose build```

```sudo docker-compose up -d```

```sudo docker-compose exec php bash```

```composer update```

```exit```


##### add this url to your machine hosts 

```myblog.dev```


##### create workout database 

```CREATE SCHEMA `db` DEFAULT CHARACTER SET utf8 ;```


##### create testing database 

```CREATE SCHEMA `db_test` DEFAULT CHARACTER SET utf8 ;```


##### run migration (import dumps)

in both "db", "db_test" databases import ```app/migrations/create_tables.sql``` then ```app/migrations/insert_dummy_data```


##### running the unit test

```./vendor/bin/phpunit --bootstrap=web/index-test.php tests/```


