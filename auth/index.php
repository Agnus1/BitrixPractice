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

    <?if (isset($_REQUEST["backurl"]) && $_REQUEST["backurl"] <> '' && preg_match('#^/\w#', $_REQUEST["backurl"])):?>
    document.location.href = "<?=CUtil::JSEscape($_REQUEST["backurl"])?>";
    <?
        LocalRedirect($_REQUEST["backurl"]);
    endif?>
</script>

<?
$APPLICATION->SetTitle("Авторизация");
?>
<p>Вы зарегистрированы и успешно авторизовались.</p>

<p><a href="<?=SITE_DIR?>">Вернуться на главную страницу</a></p>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
