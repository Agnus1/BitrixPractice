<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$userName = $USER->GetFullName();
if (!$userName)
    $userName = $USER->GetLogin();
?>
<script>
    <?if ($userName):?>
    BX.localStorage.set("eshop_user_name", "<?=CUtil::JSEscape($userName)?>", 604800);
    <?else:?>
    BX.localStorage.remove("eshop_user_name");
    <?endif?>

    <?if ($_REQUEST["TYPE"] !== 'REGISTRATION' && isset($_REQUEST["backurl"]) && $_REQUEST["backurl"] <> '' && (preg_match('#^/\w#', $_REQUEST["backurl"]) || $_REQUEST["backurl"] == "/")):?>
    document.location.href = "<?=CUtil::JSEscape($_REQUEST["backurl"])?>";
    <?
        LocalRedirect($_REQUEST["backurl"]);
    endif?>
</script>

<?
$APPLICATION->SetTitle("Авторизация");
?>
<div class="mx-auto" style="width: 40%;">
    <?php if ($_REQUEST["TYPE"] !== 'REGISTRATION'):?>
        <p>Вы спешно авторизовались.</p>
        <p><a href="<?=SITE_DIR?>">Вернуться на главную страницу</a></p>
    <?php else:?>
        <p>«Добро пожаловать!</p>
        Пожалуйста, проверьте Ваш email – мы отправили Вам приветственное письмо.<br>
        Теперь у Вас есть возможность:
        <ul>
            <li>• Сохранять в Личном кабинете персональные данные</li>
            <li>• Легко отслеживать статус Вашего заказа в режиме online</li>
            <li>• В любой момент просмотреть историю Ваших заказов</li>
        </ul>
        Что Вы хотите сделать прямо сейчас?»
    <?php endif?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
