<?php
/*
Plugin Name: SMS WP
Plugin URI: http://plugins.sonicity.eu/sms-plugin
Description: Allows your users to send SMS text messages - Through your website!
Version: 1.0.6
Author: Sonicity
Author URI: http://plugins.sonicity.eu
*/

/*  Copyright 2010 Sonicity.EU - support@sonicity.eu

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Hook for adding admin menus
add_action('admin_menu', 'sms_add_pages');

// action function for above hook
function sms_add_pages() {
    add_options_page('SMS WP', 'SMS WP', 'administrator', 'sms', 'sms_options_page');
}

// sms_options_page() displays the page content for the Test Options submenu
function sms_options_page() {

    // variables for the field and option names
    $opt_name = 'mt_sms_title';	
    $opt_name_5 = 'mt_sms_plugin_support';
    $hidden_field_name = 'mt_sms_submit_hidden';
	$data_field_name = 'mt_sms_title';
    $data_field_name_5 = 'mt_sms_plugin_support';

    // Read in existing option value from database
	$opt_val = get_option($opt_name);
    $opt_val_5 = get_option($opt_name_5);

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
		$opt_val = $_POST[$data_field_name];
        $opt_val_5 = $_POST[$data_field_name_5];

        // Save the posted value in the database
		update_option( $opt_name, $opt_val );
        update_option( $opt_name_5, $opt_val_5 );

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'SMS Plugin Options', 'mt_trans_domain' ) . "</h2>";

    // options form
    
    $change3 = get_option("mt_sms_plugin_support");

if ($change3=="Yes" || $change3=="") {
$change3="checked";
$change31="";
} else {
$change3="";
$change31="checked";
}
    ?>
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Widget Title:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo stripslashes($opt_val); ?>">
</p><hr />

<p><?php _e("Support this Plugin?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="Yes" <?php echo $change3; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="No" <?php echo $change31; ?>>No
</p>

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p><hr />

</form>
<?php
}

function show_sms($args) {
extract($args);
$pluginsupport=get_option("mt_sms_plugin_support");
$operator=$_POST['operator'];
$number=$_POST['number'];
$subject=$_POST['subject'];
$message=$_POST['message'];
$from=$_POST['from'];
$title=get_option("mt_sms_title");

if ($title=="") {
$title="Send an SMS Message";
}

if ($number!="" && $operator!="") {
switch ($operator) {
         case "verizon":
            $extra = $number."@vtext.com";
            break;
         case "tmobile":
            $extra = $number."@tmomail.net";
            break;
         case "vmobile":
            $extra = $number."@vmobl.com";
            $break;
         case "cingular":
            $extra = $number."@cingularme.com";
            break;
         case "nextel":
            $extra = $number."@messaging.nextel.com";
            break;
         case "alltel":
            $extra = $number."@message.alltel.com";
            break;
         case "sprint":
            $extra = $number."@messaging.sprintpcs.com";
            break;
         case "attmob":
            $extra = $number."@txt.att.net";
            break;
         case "attwire":
            $extra = $number."@mobile.att.net";
            break;
			case "teleflip":
            $extra = $number."@teleflip.com";
            break;
			case "ameritech":
            $extra = $number."@paging.acswireless.com";
            break;
			case "boost":
            $extra = $number."@myboostmobile.com";
            break;
			case "o2":
            $extra = $number."@mobile.celloneusa.com";
            break;
			case "aliant":
			$extra = $number."@wirefree.informe.ca";
			break;
			case "fido":
			$extra = $number."@fido.ca";
			break;
			case "telus":
			$extra = $number."@msg.telus.com";
			break;
			case "virginmobile":
			$extra = $number."@vmobile.ca";
			break;
			case "ukorange":
			$extra = "0".$number."@orange.net";
			break;
			case "uktmobile":
			$extra = "0".$number."@t-mobile.uk.net";
			break;
			case "ukvodafone":
			$extra = "0".$number."@vodafone.net";
			break;
			case "detmobile":
			$extra = "0".$number."@t-d1-sms.de";
			break;
			case "devodafone":
			$extra = "0".$number."@vodafone-sms.de";
			break;
			case "deo2":
			$extra = "0".$number."@o2online.de";
			break;
			case "rubeeline":
			$extra = $number."@sms.beemail.ru";
			break;
			case "rumts":
			$extra = "7".$number."@sms.mts.ru";
			break;
			case "ruprimtel":
			$extra = $number."@sms.primtel.ru";
			break;
			case "ruvessotel":
			$extra = $number."@pager.irkutsk.ru";
			break;
			case "portelcel":
			$extra = "91".$number."@sms.telecel.pt";
			break;
			case "poroptimus":
			$extra = "93".$number."@sms.optimus.pt";
			break;
			case "portmn":
			$extra = "96".$number."@mail.tmn.pt";
			break;
			case "ittim":
			$extra = "0".$number."@timnet.com";
			break;
			case "itvodafone":
			$extra = "3**".$number."@sms.vodafone.it";
			break;
			case "ukvirgin":
			$extra = "0".$number."@vxtras.com";
			break;
			case "jpdocomo":
			$extra = $number."@docomo.ne.jp";
			break;
			case "jpwillcom":
			$extra = $number."@pdx.ne.jp";
			break;
			case "jpvodafone":
			$extra = $number."@n.vodafone.ne.jp";
			break;
			case "inbpl":
			$extra = "9823".$number."@bplmobile.com";
			break;
			case "inairtel":
			$extra = "919890".$number."@airtelmail.com";
			break;
			case "indelhihutch":
			$extra = "9811".$number."@delhi.hutch.co.in";
			break;
			case "inideacellular":
			$extra = "9824".$number."@ideacellular.net";
			break;
			case "nltmobile":
			$extra = "31".$number."@gin.nl";
			break;
			case "nlorange":
			$extra = "0".$number."@sms.orange.nl";
			break;
			case "esmovistar":
			$extra = "0".$number."@movistar.net";
			break;
			case "esvodafone":
			$extra = "0".$number."@vodafone.es";
			break;
			case "swetele2":
			$extra = "0".$number."@sms.tele2.se";
			break;
			case "bulmtel":
			$extra = $number."@sms.mtel.net";
			break;
			case "bulglobul":
			$extra = $number."@sms.globul.bg";
			break;
			case "geeplus":
			$extra = "0".$number."@smsmail.eplus.de";
			break;
			case "geo2":
			$extra = "0".$number."@o2online.de";
			break;
			case "getmobile":
			$extra = "0".$number."@t-d1-sms.de";
			break;
			case "gevodafone":
			$extra = "0".$number."@vodafone-sms.de";
			break;
			case "isogvodafone":
			$extra = $number."@sms.is";
			break;
			case "issiminn":
			$extra = $number."@box.is";
			break;
			case "irmeteor":
			$extra = $number."@sms.mymeteor.ie";
			break;
			case "irmeteormms":
			$extra = $number."@mms.mymeteor.ie";
			break;
			case "cellularone":
			$extra = $number."@mobile.celloneusa.com";
			break;
			case "uko2":
			$extra = "44".$number."@mmail.co.uk";
			break;
			case "autmobile":
			$extra = "0".$number."@optusmobile.com.au";
			break;

         }
		 
$to = $extra;
$headers = 'From: '.$from.'\r\n Reply-To: '.$from;
	
echo $before_widget.$before_title.$title.$after_title;

if (mail($to, $subject, $message, $headers)) {
echo "Success! Message sent!";
} else {
echo "An error occured - Please try again.";
}

if ($pluginsupport=="Yes" || $pluginsupport=="") {
echo "<p style='font-size:x-small'>SMS Plugin made by <a href='http://www.xeromi.net'>Web Hosting</a>";
}

echo $after_widget;
} else {
echo $before_title.$title.$after_title.$before_widget."<br />";

echo "<form action='' method='post'>Your E-Mail: <input type='text' name='from' /><br />";

echo "Recipient's Carrier: <select name='operator'>
<optgroup label='Australia'><option value='autmobile'>T-Mobile (AU)</option></optgroup>

<optgroup label='Bulgaria'><option value='bulglobul'>Globul (BU)</option><option value='bulmtel'>Mtel (BU)</option></optgroup>

<optgroup label='Canada'><option value='aliant'>Aliant</option><option value='fido'>Fido</option><option value='telus'>Telus</option><option value='virginmobile'>Virgin Mobile</option></optgroup>

<optgroup label='Germany'><option value='geeplus'>E-Plus (DE)</option><option value='geo2'>O2 (DE)</option><option value='getmobile'>T-Mobile (DE)</option><option value='gevodafone'>Vodafone (DE)</option></optgroup>

<optgroup label='Iceland'><option value='isogvodafone'>OgVodafone (IS)</option><option value='issiminn'>Siminn (IS)</option></optgroup>

<optgroup label='India'><option value='inairtel'>AirTel (IN)</option><option value='inbpl'>BPL Mobile (IN)</option><option value='indelhihutch'>Delhi Hutch (IN)</option><option value='inideacellular'>Idea Cellular (IN)</option></optgroup>

<optgroup label='Ireland'><option value='irmeteor'>Meteor (IR)</option><option value='irmeteormms'>Meteor MMS (IR)</option></optgroup>

<optgroup label='Italy'><option value='ittim'>TIM (IT)</option><option value='itvodafone'>Vodafone (IT)</option></optgroup>

<optgroup label='Japan'><option value='jpdocomo'>NTT DoCoMo (JP)</option><option value='jpwillcom'>Willcom (JP)</option><option value='jpvodafone'>Vodafone (JP)</option></optgroup>

<optgroup label='Netherlands'><option value='nlorange'>Orange (NL)</option><option value='nltmobile'>T-Mobile (NL)</option></optgroup>

<optgroup label='Portugal'><option value='portelcel'>Telcel (POR)</option><option value='poroptimus'>Optimus (POR)</option><option value='portmn'>TMN (POR)</option></optgroup>

<optgroup label='Russia'><option value='rubeeline'>BeeLine GSM (RU)</option><option value='rumts'>MTS (RU)</option><option value='ruprimtel'>Primtel (RU)</option><option value='ruvessotel'>Vessotel (RU)</option></optgroup>

<optgroup label='Spain'><option value='esmovistar'>Telefonica Movistar (ES)</option><option value='esvodafone'>Vodafone (ES)</option></optgroup>

<optgroup label='Sweden'><option value='swetele2'>Tele2 (SWE)</option></optgroup>

<optgroup label='UK'><option value='uko2'>O2 (UK)</option><option value='ukorange'>Orange (UK)</option><option value='uktmobile'>T-Mobile (UK)</option><option value='ukvirgin'>Virgin Mobile (UK)</option><option value='ukvodafone'>Vodafone (UK)</option></optgroup>

<optgroup label='USA'><option value='alltel'>Alltel (USA)</option><option value='ameritech'>Ameritech (USA)</option><option value='attmob'>ATT Mobile (USA)</option><option value='attwire'>ATT Wireless (USA)</option><option value='boost'>Boost (USA)</option><option value='cellularone'>CellularOne (USA)</option><option value='cingular'>Cingular (USA)</option><option value='nextel'>Nextel (USA)</option><option value='o2'>O2 (USA)</option><option value='sprint'>Sprint (USA)</option><option value='teleflip'>TeleFlip (USA)</option><option value='tmobile'>T-Mobile (USA)</option><option value='verizon'>Verizon (USA)</option><option value='vmobile'>VMobile (USA)</option></optgroup>

</select><br />";

echo "Recipient's Number: <input type='text' name='number' /><br />";

echo "Subject: <input type='text' name='subject' /><br />";

echo "Message: <textarea name='message'></textarea><br />";

echo "<input type='submit' value='Send' /><br />";

if ($pluginsupport=="Yes" || $pluginsupport=="") {
echo "<p style='font-size:x-small'>SMS Plugin made by <a href='http://www.gemstoneglobesreview.com'>Gemstone Globes</a></p>";
}

echo $after_widget;
}

}

function init_sms_widget() {
register_sidebar_widget('SMS WP', 'show_sms');
}

add_action("plugins_loaded", "init_sms_widget");

?>
