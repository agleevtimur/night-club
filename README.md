# night-club

**front**
```
cd front
yarn install
yarn build
yarn start
```

**back**
```
cd back
composer install
php bin/console doctine:database:create
php bin/console doctine:migrations:diff
php bin/console doctine:migrations:migrate
symfony server:start
```

При создании базы данных обратить внимание на back/.env - DATABASE_URL
Вообще лучше .env не комитить, но при текущих обстоятельстах можно

**admin**  
Имитация админки со своим токеном  
Правила танцев задаются запросом back/request.txt
