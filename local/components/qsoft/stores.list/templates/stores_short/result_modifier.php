<?php
foreach($arResult as &$salon) {

    $arButtons = CIBlock::GetPanelButtons(
        $salon["IBLOCK_ID"],
        $salon["ID"],
        0,
        array("SECTION_BUTTONS"=>false, "SESSID"=>false)
    );

    $salon["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
    $salon["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

    $salon["EDIT_LINK_TEXT"] = $arButtons["edit"]["edit_element"]["TEXT"];
    $salon["DELETE_LINK_TEXT"] = $arButtons["edit"]["delete_element"]["TEXT"];

    if (!isset($arParams["ADD_LINK"]) && !isset($arParams["ADD_LINK_TEXT"])) {
        $arParams["ADD_LINK"] = $arButtons["edit"]["add_element"]["ACTION_URL"];
        $arParams["ADD_LINK_TEXT"] = $arButtons["edit"]["add_element"]["TEXT"];
    }
}
?>