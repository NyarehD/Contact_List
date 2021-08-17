<?php
require_once "core/base.php";
require_once "core/function.php";

$id = $_GET['id'];
if (contactDelete($id)) {
    redirect("index.php");
}