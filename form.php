<?php
$errormsg = "";
$course_name = $_POST["course_name"];
$drill_down_items = urlencode($_POST["drill_down_items"]);
if ($drill_down_items != "") {
    $dd_array = explode("%0A",$drill_down_items);
}
else {
    $dd_array = array();
}
if (empty($course_name)) {
    $errormsg = "Please enter the course name.";
}
$course_name = str_replace(" ","",$course_name);
if (!preg_match("#^[a-zA-Z0-9]+$#", $course_name)) {;
   $errormsg = "The course name should only contain numbers, letters, and spaces.";
}
else {
    $course_name = "--".strtolower(str_replace(" ","",$course_name));
}
if (empty($_POST["link_1_title"]) && empty($_POST["link_1_url"])) {
    $errormsg = "Please include at least one link.";
}
if (empty($_POST["link_1_title"]) && !empty($_POST["link_1_url"])) {
    $errormsg = "Please give Link 1 a title.";
}
$num = 1;
while ($num <= 5) {
    $link_title = "link_".$num."_title";
    $link_url = "link_".$num."_url";
    $link_type = "link_".$num."_type";
    $link_icon = "link_".$num."_icon";
    $$link_title = $_POST[$link_title];
    $$link_url = $_POST[$link_url];
    $$link_type = $_POST[$link_type];
    $$link_icon = $_POST[$link_icon];
    if (empty($$link_title) && (!empty($$link_url) || $$link_type != "Select..." || $$link_icon != "Select...")) {
        $errormsg = "Please enter a title for Link ".$num.".";
    }
    if (!empty($$link_title)) {
        if (empty($$link_url) || $$link_type == "Select..." || $$link_icon == "Select...") {
            $errormsg = "Please ensure all of the fields for Link ".$num." are filled out.";
        }
        else if (substr($$link_url, 0, 7) == "mailto:" && !filter_var(substr($$link_url,8), FILTER_VALIDATE_EMAIL)) {
                $errormsg = "Please enter a valid email address for Link ".$num.".";
        }
        else if (!filter_var($$link_url, FILTER_VALIDATE_URL)) {
            $errormsg = "Please enter a valid URL for Link ".$num.".";
        }
    }
    $num++;
}
if (empty($errormsg)) {
    $code = "<!-- BEGIN BYU PULSE SURVEY -->";
    $code = $code."\n<div style=\"background-color:white;\">";
    $code = $code."\n<ul class=\"dce-pulse ".$course_name."\" data-apvr=\"1.2\">";
    if (!empty($dd_array)) {
        foreach($dd_array as $dd) {
            if (strlen($dd) > 1 ) {
                $code = $code."\n<li>".urldecode(str_replace("+"," ",$dd))."</li>";
            }
        }
    }
    $num = 1;
    while ($num <= 5) {
        $link_title = "link_".$num."_title";
        $link_url = "link_".$num."_url";
        $link_type = "link_".$num."_type";
        $link_icon = "link_".$num."_icon";
        if (!empty($$link_title)) {
            if (!empty($$link_icon) && $$link_icon != "Select...") {
                $icon = '<i class="fas fa-'.$$link_icon.'"></i>&nbsp;';
            }
            else {
                $icon = '';
            }
            $code = $code."\n<li class=\"".$$link_type."\"><a href=\"".$$link_url."\" target=\"_blank\">".$icon.$$link_title."</a></li>";
        }
    $num++;
    }
    $code = $code."\n</ul>";
    $code = $code."\n</div>";
    $code = $code."\n<!-- END BYU PULSE SURVEY -->";
}
else {
    $code = "";
}
if (empty($errormsg)) {
    echo json_encode(['code' => 200, 'msg' => $code]);
    exit;
}
else {
    echo json_encode(['code' => 404, 'msg' => $errormsg]);
}
?>
