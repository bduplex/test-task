<?php
require('core/base.php');
require('views/imdb.php');

$params = $_GET['fnc'];

switch ($params) {
    case 'showarchive':
        //Check if date provided by post, otherwise set current date
        $imdb = new imdb();
        if ($_GET['date']){
            $date = strtotime($_GET['date']);
        }
        else{
            $date = $imdb->getCurrentDate();
        }
        $imdb->showArchiveByDate_ajax($date);
        break;
    case 'updatearchive':
        $url = 'http://www.imdb.com/chart/top';
        $imdb = new imdb();
        $imdb->updateArchive($url);
        break;
    default:
        $imdb = new imdb();
        $date = $imdb->getCurrentDate();
        $imdb->showArchiveByDate($date);
        break;
}
?>