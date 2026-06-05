<?php
class InnovationController {
    public static function originalIdea($args = []) {
        require 'app/view/innovation/viewIdea.php';
    }

    public static function mvcImprovement($args = []) {
        require 'app/view/innovation/viewImprovement.php';
    }
}

