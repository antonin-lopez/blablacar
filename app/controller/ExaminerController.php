<?php
require_once ROOT . '/app/model/ExaminerModel.php';

class ExaminerController
{
    public static function showSuperglobals($args = [])
    {
        require_once ROOT . '/app/view/examiner/viewSuperglobals.php';
    }

    public static function seedReservations($args = [])
    {
        if ($_SESSION['user_role'] !== 'administrateur') {
            header('Location: index.php?controller=home&action=home');
            exit();
        }

        $reservations = ExaminerModel::addTenRandomReservations();

        if ($reservations === false) {
            header('Location: index.php?controller=home&action=home');
            exit();
        }

        $successCount = 0;
        foreach ($reservations as $res) {
            if ($res['success']) {
                $successCount++;
            }
        }

        require_once ROOT . '/app/view/examiner/viewSuccess.php';
    }
}
