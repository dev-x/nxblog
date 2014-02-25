# 13 відправка коментарів використовуючи AJAX;
*Тимчасово відключена JavaScript валідація для форми коментів
*Відключена функція видалення комента
+AJAX відправка коментарів

﻿# 14 - profilEdit
+Добавив в базу, в таблицю Users: 
birthday date
city varchar(32)
vnz varchar(50)
groupVnz varchar(50)
mobil bigint(20)
skype varchar(50)
myCredo text
myInfo longtext
dozvil int(11)
+Добавив поле для реєстрації - Мобільний телефон
+При реєстрації в Поле dozvil реєстрації записувати туди 0;
>В users відображати тільки активних користувачів,
>Користувач з  0 неможе  коментувати, і добавляти пости,
>але може редагувати дані профілю
+Зробив активним заклатку Пост-Фотографії-Профіль

# x Добавлення фото до постів
+Наразі два статуси постів draft і publish
`ALTER TABLE `post` ADD `status` VARCHAR( 20 ) NOT NULL DEFAULT 'draft';
*Редагував формування html і JS для добавлення фото
*Зміни в контр. image/create
*Зміни у вюшках site/_posts, site/_sidebar
+Новий клас та метод app\lib\LoadImageWidget::myRun()
+Новий метод getImageUrl в app\models\Image
+Новий метод getPublishPosts в app\models\User
*Виправлена помилка в методі getImages в app\models\Post
*При добавленні фото до неіснуючого поста, створюється чорновик
*Інші зміни в jq.js та site.css