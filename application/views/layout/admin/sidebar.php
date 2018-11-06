<?php
require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
require_once Router::$Config['Language'];
session_start();
?>
<div class="w3-col m1 l1">
    <a class="w3-button w3-left toggle-menu w3-hover-none no-decoration" style="position: relative; z-index: 2; padding-top:16px; margin-left: 154px;">&#9776;</a>
    <div id="sidebar" class="w3-sidebar w3-bar-block w3-white w3-animate-left my-sidebar">
        <a class="w3-bar-item w3-cyan w3-button w3-hover-cyan w3-text-white w3-hover-text-white w3-button" style="font-size: 24px;font-weight: bold;">VAGABOND</a>
        <a id="EntryList" class="w3-bar-item w3-button ajax-link"><?php echo Language::$LANG['UI']['Sidebar']['EntryList']; ?></a>
        <a id="BlogEntryList" class="w3-bar-item w3-button ajax-link"><?php echo Language::$LANG['UI']['Sidebar']['BlogEntryList']; ?></a>
        <a id="Settings" class="w3-bar-item w3-button ajax-link"><?php echo Language::$LANG['UI']['Sidebar']['AccountSettings']; ?></a>
        <a id="SettingsBlog" class="w3-bar-item w3-button ajax-link"><?php echo Language::$LANG['UI']['Sidebar']['BlogSettings']; ?></a>
        <a id="Logout" class="w3-bar-item w3-button" onclick="Logout();"><?php echo Language::$LANG['UI']['Sidebar']['Logout']; ?></a>
    </div>
</div>