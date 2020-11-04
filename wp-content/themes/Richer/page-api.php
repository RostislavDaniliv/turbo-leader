<?php

/*

Template Name: API

*/

//$data_user = info_user($_GET['user_name']);
//echo json_encode($data_user);

$data_user = new InfoUserApi;
echo $data_user->responseRequest();

?>