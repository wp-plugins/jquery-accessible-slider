<?php

/** Define ABSPATH as this files directory */
define('ABSPATH', dirname(__FILE__) . '/../../../');
include_once(ABSPATH . "wp-config.php");

$options = get_option("widget_JQueryAccessibleSlider");
if (!is_array($options)) {
    $options = array(
        'title' => 'JQuery Accessible Slider',
        'label' => 'Number of posts to show',
        'posts' => 'Recent Posts',
        'info' => 'Move the slider to select the number of posts to show',
        'tooltip' => 'Number of posts'
    );
}
$stuffToReturn["tooltip"] = $options['tooltip'];
echo json_encode($stuffToReturn);
?>
