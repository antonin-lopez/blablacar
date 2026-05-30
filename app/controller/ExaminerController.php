<?php
class ExaminerController {
    public static function showSuperglobals(){
        require 'app/view/examiner/viewSuperglobals.php';
    }
    public static function seedReservations(){
        require 'app/view/examiner/viewCreate.php';
    }
}