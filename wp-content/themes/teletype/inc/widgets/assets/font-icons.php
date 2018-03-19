<?php
/**
 * Set Font Icons
 */
function teletype_font_icons( $display_name = false ) {
	$icons = array( 
'icon-mobile' =>
	'\e000'
,
'icon-laptop' =>
	'\e001'
,
'icon-desktop' =>
	'\e002'
,
'icon-tablet' =>
	'\e003'
,
'icon-phone' =>
	'\e004'
,
'icon-document' =>
	'\e005'
,
'icon-documents' =>
	'\e006'
,
'icon-search' =>
	'\e007'
,
'icon-clipboard' =>
	'\e008'
,
'icon-newspaper' =>
	'\e009'
,
'icon-notebook' =>
	'\e00a'
,
'icon-book-open' =>
	'\e00b'
,
'icon-browser' =>
	'\e00c'
,
'icon-calendar' =>
	'\e00d'
,
'icon-presentation' =>
	'\e00e'
,
'icon-picture' =>
	'\e00f'
,
'icon-pictures' =>
	'\e010'
,
'icon-video' =>
	'\e011'
,
'icon-camera' =>
	'\e012'
,
'icon-printer' =>
	'\e013'
,
'icon-toolbox' =>
	'\e014'
,
'icon-briefcase' =>
	'\e015'
,
'icon-wallet' =>
	'\e016'
,
'icon-gift' =>
	'\e017'
,
'icon-bargraph' =>
	'\e018'
,
'icon-grid' =>
	'\e019'
,
'icon-expand' =>
	'\e01a'
,
'icon-focus' =>
	'\e01b'
,
'icon-edit' =>
	'\e01c'
,
'icon-adjustments' =>
	'\e01d'
,
'icon-ribbon' =>
	'\e01e'
,
'icon-hourglass' =>
	'\e01f'
,
'icon-lock' =>
	'\e020'
,
'icon-megaphone' =>
	'\e021'
,
'icon-shield' =>
	'\e022'
,
'icon-trophy' =>
	'\e023'
,
'icon-flag' =>
	'\e024'
,
'icon-map' =>
	'\e025'
,
'icon-puzzle' =>
	'\e026'
,
'icon-basket' =>
	'\e027'
,
'icon-envelope' =>
	'\e028'
,
'icon-streetsign' =>
	'\e029'
,
'icon-telescope' =>
	'\e02a'
,
'icon-gears' =>
	'\e02b'
,
'icon-key' =>
	'\e02c'
,
'icon-paperclip' =>
	'\e02d'
,
'icon-attachment' =>
	'\e02e'
,
'icon-pricetags' =>
	'\e02f'
,
'icon-lightbulb' =>
	'\e030'
,
'icon-layers' =>
	'\e031'
,
'icon-pencil' =>
	'\e032'
,
'icon-tools' =>
	'\e033'
,
'icon-tools-2' =>
	'\e034'
,
'icon-scissors' =>
	'\e035'
,
'icon-paintbrush' =>
	'\e036'
,
'icon-magnifying-glass' =>
	'\e037'
,
'icon-circle-compass' =>
	'\e038'
,
'icon-linegraph' =>
	'\e039'
,
'icon-mic' =>
	'\e03a'
,
'icon-strategy' =>
	'\e03b'
,
'icon-beaker' =>
	'\e03c'
,
'icon-caution' =>
	'\e03d'
,
'icon-recycle' =>
	'\e03e'
,
'icon-anchor' =>
	'\e03f'
,
'icon-profile-male' =>
	'\e040'
,
'icon-profile-female' =>
	'\e041'
,
'icon-bike' =>
	'\e042'
,
'icon-wine' =>
	'\e043'
,
'icon-hotairballoon' =>
	'\e044'
,
'icon-globe' =>
	'\e045'
,
'icon-genius' =>
	'\e046'
,
'icon-map-pin' =>
	'\e047'
,
'icon-dial' =>
	'\e048'
,
'icon-chat' =>
	'\e049'
,
'icon-heart' =>
	'\e04a'
,
'icon-cloud' =>
	'\e04b'
,
'icon-upload' =>
	'\e04c'
,
'icon-download' =>
	'\e04d'
,
'icon-target' =>
	'\e04e'
,
'icon-hazardous' =>
	'\e04f'
,
'icon-piechart' =>
	'\e050'
,
'icon-speedometer' =>
	'\e051'
,
'icon-global' =>
	'\e052'
,
'icon-compass' =>
	'\e053'
,
'icon-lifesaver' =>
	'\e054'
,
'icon-clock' =>
	'\e055'
,
'icon-aperture' =>
	'\e056'
,
'icon-quote' =>
	'\e057'
,
'icon-scope' =>
	'\e058'
,
'icon-alarmclock' =>
	'\e059'
,
'icon-refresh' =>
	'\e05a'
,
'icon-happy' =>
	'\e05b'
,
'icon-sad' =>
	'\e05c'
,
'icon-facebook' =>
	'\e05d'
,
'icon-twitter' =>
	'\e05e'
,
'icon-googleplus' =>
	'\e05f'
,
'icon-rss' =>
	'\e060'
,
'icon-tumblr' =>
	'\e061'
,
'icon-linkedin' =>
	'\e062'
,
'icon-dribbble' =>
	'\e063'
);
	?>
	<div class="font-icons-picker">
		<?php
		foreach ( $icons as $icon => $code ) {
			?>
			<div class="c4" data-value="<?php echo $icon; ?>"><div><i class="icon <?php echo $icon; ?>"></i><?php if ( $display_name ) echo $icon; ?></div></div>
			<?php
		}
		?>
	</div>
	<?php
}