# emailsender
for test

По условию задачи есть таблица users, одно из полей confirmed имеет 1 если зарегистрированный пользователь получил письмо и перешел по сформированной для него ссылке для подтверждения email. Значит, если это поле имеет 1, то email: во-первых "валидный", во-вторых принадлежит этому пользователю с высокой вероятностью. Использовать таблицу emails с данными проверки емейл на валидность и платную фцнкцию check_email( $email ) не имеет смысла.

В качестве сервиса по подготовке списка клиентов для отправки писем и непосредственно отправка реализованы в одномо бъекте. Это несколько отходит от принципа SOLID, однако, исходя из специфики этого "сервиса", его не планируется запускать вручную и по нескольку экземпляров. По этой же причине не использовался синглтон для подключения к БД. Это решение может быть не подходящим для конкретного проекта.

С учетом объема данных 1 000 000 записей, ежедневный объем рассылаемых писем будет в среднем 2740 штук, рассылку целесообразно запускать автоматически по расписанию. В ночное время нагрузка на сервера ниже, но получение уведомления о новом письме в ночное время на телефон может раздражать клиентов.
