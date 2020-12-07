# Генератор футбольных матчей

## Описания решения задачи 
- Разработано приложение, которое случайным образом подбирает все возможные комбинации пар соперников исключая повторы. Каждая команда имеет 7 игр и может играть их, как дома, так и на выезде последовательность определяет алгоритм кругового турнира. У каждой команды обозначены маркеры или **H**(играла дома) или **W**(играла на выезде), каждая игра идет до победы победитель получает 3 очка.

###  Какие технологии были использованы и почему? (php-fpm7.1, Nginx,  Mysql5.7.*, docker),
- php-fpm и Nginx по тому что через менеджер процессов fpm по сокету выдает приличное уменьшение скорости.
- Mysql5.7.*(Percona) - для быстрой работы приложения нужно постоянно ходить в базу за данными которые очень часто предоставлять пользователю, а так же обновлять(реже) и добавлять новые записи, Mysql на select быстрая, а выборок из базы у нас большее количество.
- Docker для локальной разработки и продакшен окружения.
- phpUnit для функционального и модульного тестирования.

### Архитектура приложения 
- Основная директория - Sr, там расположено все что необходимо и достаточно для работы приложения, кроме миграций для БД.
- Основной namespace - EnglandSoccerCup
- Основные директории Http для контролеров приложения, директория Services содержит слой бизнес логики в нашем случае это генерация результатов и генерация всех возможных пар, директория Repositories служит для реализации которые позволяют работать с Eloquent,  Providers для подключения наших зависимостей и можно было использовать DI контейнеры, Models для мапинга полей сущностей.
### Архитектура базы 
-  Приложение использует 2 таблицы **division** для хранения команд и **result** для хранения результатов команд, таблица result имеет внешние ключи к таблице 
division, дополнительно еще были созданы индексы на колонки которые ссылаются на   таблицу division.
