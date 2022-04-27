# SNL

Projekt Galerii grupy SNL na PAI
Baza danych SQL na MySQL

## PORADNIK DO SYMFONY
### Aby zacząć korzystać z symfony należy przejść do katalogu Project i włączyć xamppa
* ./symfony server:start - uruchomienie serwera
* Strona znajduje się pod adresem  https://127.0.0.1:8000/api
* .env został skonfigurowany na podstawie poradnika
* php ./bin/console doctrine:database:create - utworzenie bazy danych o nazwie "snl" (nazwa pochodzi od danych podanych w .env)
* php ./bin/console doctrine:schema:update --dump-sql  - sprawdzenie wygenerowanego sql przed wykonaniem
* php ./bin/console doctrine:schema:update --force  - wykonanie sql query
