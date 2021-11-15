<?php
include("page/account/right-user.php");


include("functii/widget_rightside.php");

foreach (glob("widget/right/*.php") as $filename)
{
    include $filename;
}

?>
