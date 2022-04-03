<?php 
session_start();
include_once('../layout/functions/functions.php');
$method = $_GET['method'];
if($method != "") {
    $home = new HomeController();
    if($method = 'showColleges'){
        $id=$_GET['id'];
        $home->showColleges($id);
    } 
}

class HomeController {
    public function showColleges($id) {
        $joins = 'faculities f LEFT JOIN books b ON b.faculty_id = f.id where uni_id ='.$id;
        $_SESSION['faculities'] = selectAll(' f.* , count(b.id) as count', $joins);
        header('location: ../colleges.php');
    }
}