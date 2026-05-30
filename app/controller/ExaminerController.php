<?php
require_once ROOT . '/app/model/ExaminerModel.php';

class ExaminerController
{
    public static function showSuperglobals(){
        require 'app/view/examiner/viewSuperglobals.php';
    }

    public static function seedReservations($args)
    {
        if ($_SESSION['user_role'] !== 'administrateur') {
            header('Location: index.php?controller=home&action=home');
            exit();
        }
        
        $results = ExaminerModel::addTenRandomReservations();
        
        require_once ROOT . '/app/view/examiner/viewSuccess.php';
    }
}
?>