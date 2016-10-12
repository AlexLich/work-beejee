# work-beejee
тестовое задание
--- Базовая функциональность ---

Сделать форму обратной связи. 

*	На странице должны быть показаны все оставленные отзывы, под ними форма: Имя, E-mail, текст сообщения, кнопки "Предварительный просмотр" и "Отправить".
*	Отзывы можно сортировать по имени автора, e-mail и дате добавления (по умолчанию - по дате, последние наверху).
* Также должна быть валидация.
*	Предварительный просмотр должен работать без перезагрузки страницы.

Сделать вход для администратора (логин "admin", пароль "123"). 

*	Администратор должен иметь возможность редактировать отзыв. 
*	Измененные отзывы в общем списке выводятся с пометкой "изменен администратором".

К отзыву можно прикрепить картинку.

*	Картинка должна быть не более 320х240 пикселей, при попытке залить изображение большего размера, картинка должна быть пропорционально уменьшена до заданных размеров. Допустимые форматы: JPG, GIF, PNG.

У администратора должна быть возможность модерирования.

*	Т.е. на странице администратора показаны отзывы с миниатюрами картинок и их статусы (принят/отклонен).

Отзыв становится видимым для всех только после принятия админом. Отклоненные отзывы остаются в базе, но не показываются обычным пользователям. Изменение картинки администратором не требуется.

В приложении нужно с помощью чистого PHP реализовать модель MVC (PHP-фреймворки использовать нельзя).
Верстка на bootstrap. Помните, что аккуратность - это один из главных критериев оценки тестового.

Приложение нужно развернуть на любом бесплатном хостинге, чтобы можно было посмотреть его в действии. 
Скопируйте в корневую папку проекта наш онлайн-редактор dayside (https://github.com/boomyjee/dayside)
Таким образом редактор будет доступен по url <ваш проект>/dayside/index.php
Убедитесь, что настройки .htaccess подволяют редактору открыться. При первом запуске редактор попросит установить пароль,  поставьте как в админке: 123.
