<?php
include('config.php');    //include of db config file
require('auth.php');
$user_id = ($_SESSION['user_id']);

function paginate($reload, $page, $tpages) {
    $adjacents = 3;
    $prevlabel = "&lsaquo; Előző";
    $nextlabel = "Következő &rsaquo;";
    $out = ""; 
	$menu = ($_GET['menu']);
    // previous
    if ($page == 1) {
        $out.= "<span>" . $prevlabel . "</span>\n";
    } elseif ($page == 2) {
        $out.= "<li><a  href=\"" . $reload . "\">" . $prevlabel . "</a>\n</li>";
    } else {
        $out.= "<li><a  href=\"" . $reload . "&amp;page=" . ($page - 1) . "&menu=".$menu."\">" . $prevlabel . "</a>\n</li>";
    }
  
    $pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
    $pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
	
	if ($page >  4) {
        //$out.= "<li><a  href=\"" . $reload . "&amp;page=" . $tpages . "\">" . $tpages . "</a>\n</li>";
		$out.= "<li><a  href=\"" . $reload . "&amp;page=1&menu=".$menu."\">Legelső</a>\n</li>";
    }
    for ($i = $pmin; $i <= $pmax; $i++) {
        if ($i == $page) {
            $out.= "<li  class=\"active\"><a href=''>" . $i . "</a></li>\n";
        } elseif ($i == 1) {
            $out.= "<li><a  href=\"" . $reload . "&menu=".$menu."\">" . $i . "</a>\n</li>";
        } else {
            $out.= "<li><a  href=\"" . $reload . "&amp;page=" . $i . "&menu=".$menu."\">" . $i . "</a>\n</li>";
        }
    }
    
    if ($page < ($tpages - $adjacents)) {
        //$out.= "<li><a  href=\"" . $reload . "&amp;page=" . $tpages . "\">" . $tpages . "</a>\n</li>";
		$out.= "<li><a  href=\"" . $reload . "&amp;page=" . $tpages . "&menu=" . $menu . "\">Utolsó</a>\n</li>";
    }
	
	
    // next
    if ($page < $tpages) {
        $out.= "<li><a  href=\"" . $reload . "&amp;page=" . ($page + 1) . "&menu=".$menu."\">" . $nextlabel . "</a>\n</li>";
    } else {
        $out.= "<span>" . $nextlabel . "</span>\n";
    }
    $out.= "";
    return $out;
}
