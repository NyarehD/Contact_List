<?php

function connectionToDB(){
    return mysqli_connect("localhost","root","","homework");
}
$url = "http://{$_SERVER['HTTP_HOST']}/homework";