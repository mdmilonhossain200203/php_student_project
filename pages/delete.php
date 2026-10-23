<?php
require_once __DIR__ . '/studentCrud.php';

use  pages\studentCrud\Crud;

$d_id = isset($_REQUEST['d_id']) ? $_REQUEST['d_id'] : null;


if ($d_id) {
    $crud = new Crud();
    $crud->delete($d_id);
}
