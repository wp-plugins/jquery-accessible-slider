<?php
/*
Plugin Name: JQuery Accessible Slider
Plugin URI: http://wordpress.org/extend/plugins/jquery-accessible-slider/
Description: WAI-ARIA Enabled Slider Plugin for Wordpress
Author: Kontotasiou Dionysia
Version: 3.0
Author URI: http://www.iti.gr/iti/people/Dionisia_Kontotasiou.html
*/

add_action("plugins_loaded", "JQueryAccessibleSlider_init");
function JQueryAccessibleSlider_init() {
    register_sidebar_widget(__('JQuery Accessible Slider'), 'widget_JQueryAccessibleSlider');
    register_widget_control(   'JQuery Accessible Slider', 'JQueryAccessibleSlider_control', 200, 200 );
    if ( !is_admin() && is_active_widget('widget_JQueryAccessibleSlider') ) {
        wp_register_style('jquery.ui.all', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-slider/lib/jquery-ui/themes/base/jquery.ui.all.css'));
        wp_enqueue_style('jquery.ui.all');

        wp_deregister_script('jquery');

        // add your own script
        wp_register_script('jquery-1.6.4', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-slider/lib/jquery-ui/jquery-1.6.4.js'));
        wp_enqueue_script('jquery-1.6.4');

        wp_register_script('jquery.ui.core', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-slider/lib/jquery-ui/ui/jquery.ui.core.js'));
        wp_enqueue_script('jquery.ui.core');

        wp_register_script('jquery.ui.widget', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-slider/lib/jquery-ui/ui/jquery.ui.widget.js'));
        wp_enqueue_script('jquery.ui.widget');

        wp_register_script('jquery.ui.mouse', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-slider/lib/jquery-ui/ui/jquery.ui.mouse.js'));
        wp_enqueue_script('jquery.ui.mouse');

        wp_register_script('jquery.ui.slider', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-slider/lib/jquery-ui/ui/jquery.ui.slider.js'));
        wp_enqueue_script('jquery.ui.slider');

        wp_register_script('jquery.ui.accordion', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-slider/lib/jquery-ui/ui/jquery.ui.accordion.js'));
        wp_enqueue_script('jquery.ui.accordion');

        wp_register_style('demos', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-slider/lib/jquery-ui/demos.css'));
        wp_enqueue_style('demos');

        wp_register_script('JQueryAccessibleSlider', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-slider/lib/JQueryAccessibleSlider.js'));
        wp_enqueue_script('JQueryAccessibleSlider');

        wp_register_style('JQueryAccessibleSlider_css', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-slider/lib/JQueryAccessibleSlider.css'));
        wp_enqueue_style('JQueryAccessibleSlider_css');
    }
}

function widget_JQueryAccessibleSlider($args) {
    extract($args);

    $options = get_option("widget_JQueryAccessibleSlider");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'JQuery Accessible Slider',
            'label' => 'Number of posts to show',
            'posts' => 'Recent Posts',
            'info' => 'Move the slider to select the number of posts to show',
            'tooltip' => 'Number of posts'
        );
    }

    echo $before_widget;
    echo $before_title;
    echo $options['title'];
    echo $after_title;

    //Our Widget Content
    JQueryAccessibleSliderContent();
    echo $after_widget;
}

function JQueryAccessibleSliderContent() {
    $options = get_option("widget_JQueryAccessibleSlider");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'JQuery Accessible Slider',
            'label' => 'Number of posts to show',
            'posts' => 'Recent Posts',
            'info' => 'Move the slider to select the number of posts to show',
            'tooltip' => 'Number of posts'
        );
    }

    echo '<div class="demo" role="application">
            <label for="slider">' . $options['label'] . '</label>
            <br />
            <span id="slider1Val" class="sliderValue">#0</span>
            <br />
            <div class="slider" id="slider"></div>
            <br />
	
	<div class="areaBSlider">
	</div>
</div>';
}

function JQueryAccessibleSlider_control() {
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

    if ($_POST['JQueryAccessibleSlider-SubmitTitle']) {
        $options['title'] = htmlspecialchars($_POST['JQueryAccessibleSlider-WidgetTitle']);
        update_option("widget_JQueryAccessibleSlider", $options);
    }
    if ($_POST['JQueryAccessibleSlider-SubmitLabel']) {
        $options['label'] = htmlspecialchars($_POST['JQueryAccessibleSlider-WidgetLabel']);
        update_option("widget_JQueryAccessibleSlider", $options);
    }
    if ($_POST['JQueryAccessibleSlider-SubmitPosts']) {
        $options['posts'] = htmlspecialchars($_POST['JQueryAccessibleSlider-WidgetPosts']);
        update_option("widget_JQueryAccessibleSlider", $options);
    }
    if ($_POST['JQueryAccessibleSlider-SubmitInfo']) {
        $options['info'] = htmlspecialchars($_POST['JQueryAccessibleSlider-WidgetInfo']);
        update_option("widget_JQueryAccessibleSlider", $options);
    }
    if ($_POST['JQueryAccessibleSlider-SubmitTooltip']) {
        $options['tooltip'] = htmlspecialchars($_POST['JQueryAccessibleSlider-WidgetTooltip']);
        update_option("widget_JQueryAccessibleSlider", $options);
    }
    ?>
    <p>
        <label for="JQueryAccessibleSlider-WidgetTitle">Widget Title: </label>
        <input type="text" id="JQueryAccessibleSlider-WidgetTitle" name="JQueryAccessibleSlider-WidgetTitle" value="<?php echo $options['title'];?>" />
        <input type="hidden" id="JQueryAccessibleSlider-SubmitTitle" name="JQueryAccessibleSlider-SubmitTitle" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleSlider-WidgetLabel">Translation for "Number of posts to show": </label>
        <input type="text" id="JQueryAccessibleSlider-WidgetLabel" name="JQueryAccessibleSlider-WidgetLabel" value="<?php echo $options['label'];?>" />
        <input type="hidden" id="JQueryAccessibleSlider-SubmitLabel" name="JQueryAccessibleSlider-SubmitLabel" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleSlider-WidgetPosts">Translation for "Recent Posts": </label>
        <input type="text" id="JQueryAccessibleSlider-WidgetPosts" name="JQueryAccessibleSlider-WidgetPosts" value="<?php echo $options['posts'];?>" />
        <input type="hidden" id="JQueryAccessibleSlider-SubmitPosts" name="JQueryAccessibleSlider-SubmitPosts" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleSlider-WidgetInfo">Translation for "Move the slider to select the number of posts to show": </label>
        <input type="text" id="JQueryAccessibleSlider-WidgetInfo" name="JQueryAccessibleSlider-WidgetInfo" value="<?php echo $options['info'];?>" />
        <input type="hidden" id="JQueryAccessibleSlider-SubmitInfo" name="JQueryAccessibleSlider-SubmitInfo" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleSlider-WidgetTooltip">Translation for "Number of posts": </label>
        <input type="text" id="JQueryAccessibleSlider-WidgetTooltip" name="JQueryAccessibleSlider-WidgetTooltip" value="<?php echo $options['tooltip'];?>" />
        <input type="hidden" id="JQueryAccessibleSlider-SubmitTooltip" name="JQueryAccessibleSlider-SubmitTooltip" value="1" />
    </p>
    
    <?php
}

?>
