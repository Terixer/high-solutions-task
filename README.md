# High Solutions recruitment task 
## Kwestie techniczne

### Instalacja


```
composer install
cp ./.env.example ./.env
```
Uzupełnienie informacji odnośnie bazy danych.
```
php artisan key:generate
composer prod-install
```

### Serwer

```
php artisan serve
```


### Testy
Feature i unit testy
```
php artisan test
```

## Api

### Rejestracja
Rejestracja użytkownika
- Wymagany Header `Accept:application/json`
- Wymagane Dane `email`,`password`,`password_confirmation`
- `/api/register` **(POST)**
### Logowanie
Logowanie użytkownika
- Wymagane Header `Accept:application/json`
- Wymagane Dane `email`,`password`
- `/api/login` **(POST)**
### Lista postaci
- Wymagane Header `Authentication: {api_token}` oraz `Accept:application/json`
- `/api/people` **(GET)**
### Postać
Postać szukana po name
- Wymagane Header `Authentication: {api_token}` oraz `Accept:application/json`
- `/api/people/{person_name}` **(GET)**

## Rozwiązania programistyczne
### Command line do pobierania postaci z swapi
Stworzyłem command line, który w łatwy sposób pobiera postaci z swapi. Command został tak zaprojektowany, aby mógł łatwo pobrać elementy również z innych swapi url.
```bash
php artisan swapi:fetch:people {people_to_fetch_count}
```
### Laravel Passport (OAuth2)
Zastosowałem Laravel Passport i postawiłem endpointy za zalogowanym użytkownikiem.  
### Kodowanie bazy danych
`utf8_general_ci`
### Testy
Testy dzielą się na feature oraz unit.
### Gitflow
W aplikacji zastosowałem uproszczony gitflow (bez HOTFIX, ze względu na brak produkcyjny)
```bash
master -> develop -> developerName/featureName
```
## Inne kwestie
### Czas pracy
- 2,5h - tyle zajęłaby mi praca jeżeli zrobiłbym tylko wymagane minimum
- 6h - tyle zajęło mi faktycznie zrobienie tego wszystkiego (nie będę ukrywał, że zadanie bardzo mi się spodobało i chciałem je troszkę `przekombinować`)
### Produkcja
Aplikacja działa na Heroku http://high-solutions-task.herokuapp.com/ - korzysta z połączenia z bazą mySql
### ToDo
- Nie dodałem abstrakcji serwisom, przez co są zbyt konkretne
- Niestety nie zdąrzyłem przetestować odpowiednio serwisów
- Rozdzielenie elementów commend'a na serwisy
