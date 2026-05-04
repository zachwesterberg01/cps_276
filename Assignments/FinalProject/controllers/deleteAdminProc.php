<?php
require_once 'classes/Pdo_methods.php';

$pdo     = new PdoMethods();
$msg     = "<p>&nbsp;</p>";
$deleted = false;

if (isset($_POST['delete'])) {
    if (isset($_POST['chkbx'])) {

        foreach ($_POST['chkbx'] as $id) {

            $sql = "DELETE FROM admins WHERE id = :id";
            $bindings = [
                [':id', $id, 'int'],
            ];
            $result = $pdo->otherBinded($sql, $bindings);

            if ($result === 'error') {
                $msg = "<p style='color:red'>There was a problem deleting this record.</p>";
                break;
            }
            else {
                $deleted = true;
            }
        }
    }
}


$sql     = "SELECT * FROM admins";
$records = $pdo->selectNotBinded($sql);
?>
