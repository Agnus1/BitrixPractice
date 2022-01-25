<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
define("HIDE_SIDEBAR", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 ошибка: Страница не найдена");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
?>

<div class="bx-404-container">
	К сожалению, такая страница не найдена.<br>

	Данная страница была удалена с сайта, либо ее никогда не существовало. Вы можете вернуться на Главную страницу (ссылка на главную страницу - /) или воспользоваться поиском (ссылка на страницу Поиска - /search/).
	<br>

	Если Вы хотите что-то сообщить, напишите нам с помощью формы Обратная связь (ссылка на страницу Контактная информация - /company/contacts/).
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>