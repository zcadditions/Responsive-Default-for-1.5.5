<?php
/**
 * Common Template - tpl_main_page.php
 *
 * Governs the overall layout of an entire page<br />
 * Normally consisting of a header, left side column. center column. right side column and footer<br />
 * For customizing, this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * - make a directory /templates/my_template/privacy<br />
 * - copy /templates/templates_defaults/common/tpl_main_page.php to /templates/my_template/privacy/tpl_main_page.php<br />
 * <br />
 * to override the global settings and turn off columns un-comment the lines below for the correct column to turn off<br />
 * to turn off the header and/or footer uncomment the lines below<br />
 * Note: header can be disabled in the tpl_header.php<br />
 * Note: footer can be disabled in the tpl_footer.php<br />
 * <br />
 * $flag_disable_header = true;<br />
 * $flag_disable_left = true;<br />
 * $flag_disable_right = true;<br />
 * $flag_disable_footer = true;<br />
 * <br />
 * // example to not display right column on main page when Always Show Categories is OFF<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 * <br />
 * example to not display right column on main page when Always Show Categories is ON and set to categories_id 3<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '' or $cPath == '3') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php 7085 2007-09-22 04:56:31Z ajeh $
 * @version ZCA/GIT: $Id: rbarbour New for v1.5.5 $
 */

/** bof DESIGNER TESTING ONLY: */
// $messageStack->add('header', 'this is a sample error message', 'error');
// $messageStack->add('header', 'this is a sample caution message', 'caution');
// $messageStack->add('header', 'this is a sample success message', 'success');
// $messageStack->add('main', 'this is a sample error message', 'error');
// $messageStack->add('main', 'this is a sample caution message', 'caution');
// $messageStack->add('main', 'this is a sample success message', 'success');
/** eof DESIGNER TESTING ONLY */



// the following IF statement can be duplicated/modified as needed to set additional flags
  if (in_array($current_page_base,explode(",",'list_pages_to_skip_all_right_sideboxes_on_here,separated_by_commas,and_no_spaces')) ) {
    $flag_disable_right = true;
  }

// ZCAdditions.com, ZCA Responsive Components (BOF-add 1 of 11)
if ($flag_disable_right or COLUMN_RIGHT_STATUS == '0') {
$right_column = '0';
}else{
$right_column = SET_COLUMN_RIGHT_LAYOUT;
}

if ($flag_disable_left or COLUMN_LEFT_STATUS == '0') {
$left_column = '0';
}else{ 
$left_column = SET_COLUMN_LEFT_LAYOUT;
}

if ($right_column == '0' && $left_column == '0') {
$center_column = SET_COLUMN_CENTER_LAYOUT + SET_COLUMN_RIGHT_LAYOUT + SET_COLUMN_LEFT_LAYOUT;
} else if ($right_column == '0') {
$center_column = SET_COLUMN_CENTER_LAYOUT + SET_COLUMN_RIGHT_LAYOUT;
} else if ($left_column == '0') {
$center_column = SET_COLUMN_CENTER_LAYOUT + SET_COLUMN_LEFT_LAYOUT;
} else {
$center_column = SET_COLUMN_CENTER_LAYOUT;
}
// ZCAdditions.com, ZCA Responsive Components (EOF-add 1 of 11)

  $header_template = 'tpl_header.php';
  $footer_template = 'tpl_footer.php';
  $left_column_file = 'column_left.php';
  $right_column_file = 'column_right.php';
  $body_id = ($this_is_home_page) ? 'indexHome' : str_replace('_', '', $_GET['main_page']);
?>
<body id="<?php echo $body_id . 'Body'; ?>"<?php if($zv_onload !='') echo ' onload="'.$zv_onload.'"'; ?>>

<!--ZCAdditions.com, ZCA Responsive Components (BOF-add 2 of 11)-->
<!--bof-mainWrapper-->
<div id="mainWrapper" class="layout">

<!--bof-headerWrapper-->
<div id="headerWrapper" class="columns12"><!--columns12 equals 100%-->
<!--ZCAdditions.com, ZCA Responsive Components (EOF-add 2 of 11)-->

<?php
  if (SHOW_BANNERS_GROUP_SET1 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET1)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerOne" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>

<!--<div id="mainWrapper">ZCAdditions.com, ZCA Responsive Components (BOF-del 3 of 11) -->
<?php
 /**
  * prepares and displays header output
  *
  */
  if (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_HEADER_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == '')) {
    $flag_disable_header = true;
  }
  require($template->get_template_dir('tpl_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_header.php');?>

<!--ZCAdditions.com, ZCA Responsive Components (BOF-add 4 of 11)-->
</div>
<!--eof-headerWrapper-->
<!--ZCAdditions.com, ZCA Responsive Components (BOF-add 4 of 11)-->

<!--<table width="100%" border="0" cellspacing="0" cellpadding="0" id="contentMainWrapper"><tr>  ZCAdditions.com, ZCA Responsive Components (BOF-del 5 of 11) -->

<?php
if (COLUMN_LEFT_STATUS == 0 || (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '') || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_LEFT_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == ''))) {
  // global disable of column_left
  $flag_disable_left = true;
}
if (!isset($flag_disable_left) || !$flag_disable_left) {
?>

<!--ZCAdditions.com, ZCA Responsive Components (BOF-add 6 of 11)-->
<!--bof-asideLeftWrapper-->
<div id="asideLeftWrapper" class="columns<?php echo $left_column; ?>">
<!--ZCAdditions.com, ZCA Responsive Components (BOF-add 6 of 11)-->

<!--<td id="navColumnOne" class="columnLeft" style="width: <?php echo COLUMN_WIDTH_LEFT; ?>">ZCAdditions.com, ZCA Responsive Components (BOF-del 7 of 11)-->

<?php
 /**
  * prepares and displays left column sideboxes
  *
  */
?>
<!--<div id="navColumnOneWrapper" style="width: <?php echo BOX_WIDTH_LEFT; ?>">ZCAdditions.com, ZCA Responsive Components (BOF-del 8 of 11)-->

<?php require(DIR_WS_MODULES . zen_get_module_directory('column_left.php')); ?>

<!--</div></td>ZCAdditions.com, ZCA Responsive Components (BOF-del 9 of 11)-->

<!--ZCAdditions.com, ZCA Responsive Components (BOF-add 10 of 10)-->
</div>
<!--eof-asideLeftWrapper-->
<!--ZCAdditions.com, ZCA Responsive Components (EOF-add 10 of 10)-->

<?php
}
?>

<!--<td valign="top">ZCAdditions.com, ZCA Responsive Components (BOF-del 11 of 11)-->

<!--ZCAdditions.com, ZCA Responsive Components (BOF-add 12 of 10)-->
<!--bof-sectionWrapper-->
<div id="sectionWrapper" class="columns<?php echo $center_column; ?>">
<!--ZCAdditions.com, ZCA Responsive Components (EOF-add 12 of 10)-->

<!-- bof  breadcrumb -->
<?php if (DEFINE_BREADCRUMB_STATUS == '1' || (DEFINE_BREADCRUMB_STATUS == '2' && !$this_is_home_page) ) { ?>
    <div id="navBreadCrumb"><?php echo $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); ?></div>
<?php } ?>
<!-- eof breadcrumb -->

<?php
  if (SHOW_BANNERS_GROUP_SET3 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET3)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerThree" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>

<!-- bof upload alerts -->
<?php if ($messageStack->size('upload') > 0) echo $messageStack->output('upload'); ?>
<!-- eof upload alerts -->

<?php
 /**
  * prepares and displays center column
  *
  */
 require($body_code); ?>

<?php
  if (SHOW_BANNERS_GROUP_SET4 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET4)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerFour" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>

<!--</td>ZCAdditions.com, ZCA Responsive Components (BOF-del 13 of 11)-->

<!--ZCAdditions.com, ZCA Responsive Components (BOF-add 14 of 10)-->
</div>
<!--eof-sectionWrapper-->
<!--ZCAdditions.com, ZCA Responsive Components (EOF-add 14 of 10)-->

<?php
//if (COLUMN_RIGHT_STATUS == 0 || (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '') || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF == 'true' && $_SESSION['customers_authorization'] != 0)) {
if (COLUMN_RIGHT_STATUS == 0 || (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '') || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == ''))) {
  // global disable of column_right
  $flag_disable_right = true;
}
if (!isset($flag_disable_right) || !$flag_disable_right) {
?>

<!--<td id="navColumnTwo" class="columnRight" style="width: <?php echo COLUMN_WIDTH_RIGHT; ?>">ZCAdditions.com, ZCA Responsive Components (BOF-del 15 of 11)-->

<!--ZCAdditions.com, ZCA Responsive Components (BOF-add 16 of 10)-->
<!--bof-asideRightWrapper-->
<div id="asideRightWrapper" class="columns<?php echo $right_column; ?>">
<!--ZCAdditions.com, ZCA Responsive Components (EOF-add 16 of 10)-->

<?php
 /**
  * prepares and displays right column sideboxes
  *
  */
?>

<!--<div id="navColumnTwoWrapper" style="width: <?php echo BOX_WIDTH_RIGHT; ?>">ZCAdditions.com, ZCA Responsive Components (BOF-del 17 of 11)-->

<?php require(DIR_WS_MODULES . zen_get_module_directory('column_right.php')); ?>

<!--</div></td>ZCAdditions.com, ZCA Responsive Components (BOF-del 18 of 11)-->

<!--ZCAdditions.com, ZCA Responsive Components (BOF-add 19 of 10)-->
</div>
<!--eof-asideRightWrapper-->
<!--ZCAdditions.com, ZCA Responsive Components (BOF-add 19 of 10)-->

<?php
}
?>

<!--</tr></table>ZCAdditions.com, ZCA Responsive Components (BOF-del 20 of 11)-->

<!--ZCAdditions.com, ZCA Responsive Components (BOF-add 21 of 10)-->
<br class="clearBoth" />
<br class="clearBoth" />

<!--bof-footerWrapper-->
<div id="footerWrapper" class="columns12"><!--columns12 equals 100%-->
<!--ZCAdditions.com, ZCA Responsive Components (EOF-add 21 of 10)-->

<?php
 /**
  * prepares and displays footer output
  *
  */
  if (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_FOOTER_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == '')) {
    $flag_disable_footer = true;
  }
  require($template->get_template_dir('tpl_footer.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_footer.php');
?>

<!--</div>ZCAdditions.com, ZCA Responsive Components (BOF-del 22 of 11)-->

<!--bof- parse time display -->
<?php
  if (DISPLAY_PAGE_PARSE_TIME == 'true') {
?>
<div class="smallText center">Parse Time: <?php echo $parse_time; ?> - Number of Queries: <?php echo $db->queryCount(); ?> - Query Time: <?php echo $db->queryTime(); ?></div>
<?php
  }
?>
<!--eof- parse time display -->
<!--bof- banner #6 display -->
<?php
  if (SHOW_BANNERS_GROUP_SET6 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET6)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerSix" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>
<!--eof- banner #6 display -->

<!--ZCAdditions.com, ZCA Responsive Components (BOF-add 23 of 10)-->
</div>
<!--eof-footerWrapper-->

<br class="clearBoth" />
<br class="clearBoth" />

</div>
<!--eof-mainWrapper -->
<!--ZCAdditions.com, ZCA Responsive Components (EOF-add 23 of 10)-->

<?php /* add any end-of-page code via an observer class */
  $zco_notifier->notify('NOTIFY_FOOTER_END', $current_page);
?>
</body>
