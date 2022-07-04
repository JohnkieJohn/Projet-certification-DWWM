<?php

require './vendor/autoload.php';

use project\library\Orders;
use project\library\Users;

if (isset($_POST['id_user']))
{
    $id_user = $_POST['id_user'];
}
else
{
    $id_user = $_SESSION['id_user'];
}

$db = new Orders();
$data = $db->deleteOrder($id_user);
$db2 = new Users();
$data2 = $db2->deleteUser($id_user);

header('location: ?page=usersList');

?>