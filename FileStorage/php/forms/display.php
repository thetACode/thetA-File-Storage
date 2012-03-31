<?php
/*
 * Display
 */
class display
{
    public function init() {
        
    }
    
    public static function draw() {
        include_once 'php/actions/search.php';
        
        $search = new search();
        $search->searchhome();
    }
    
    public static function drawside() {
        include_once 'php/actions/search.php';
        
        $search = new search();
        $search->searchsidebar();
    }

}
?>
