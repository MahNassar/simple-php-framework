# native-php-blog

simple blog with native php mvc framework

### installation guide :- 

```sudo docker-compose build```

```sudo docker-compose up -d```

```sudo docker-compose exec php bash```

```composer update```

```exit```


##### add this url to your machine hosts 

```check24.dev```


##### create workout database 

```CREATE SCHEMA `check24` DEFAULT CHARACTER SET utf8 ;```


##### create testing database 

```CREATE SCHEMA `check24_test` DEFAULT CHARACTER SET utf8 ;```


##### run migration (import dumps)

in both "check24", "check24_test" databases import ```app/migrations/create_tables.sql``` then ```app/migrations/insert_dummy_data```


##### running the unit test

```./vendor/bin/phpunit --bootstrap=web/index-test.php tests/```


