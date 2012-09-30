<?php function css_options() {

$logo = of_get_option('clarity_logo');
			    list($width, $height, $type, $attr) = getimagesize( $logo );
			    
?>
.sitelogoimg {
	background-image: url("<?php echo $logo; ?>");
	background-repeat: no-repeat;
	background-size: <?php echo $width; ?>px <?php echo $height; ?>px;
	width: <?php echo $width; ?>px;
	height: <?php echo $height; ?>px;
	margin: 0 auto;
}

<?php if ( of_get_option('clarity_logo_retina') != '' ) { ?>
@media  (min--moz-device-pixel-ratio: 1.5),
        (-o-min-device-pixel-ratio: 3/2),
        (-webkit-min-device-pixel-ratio: 1.5),
        (min-device-pixel-ratio: 1.5),
        (min-resolution: 1.5dppx) {
	/* Use 2x images for retina */
.sitelogoimg {
	background-image: url("<?php echo of_get_option('clarity_logo_retina'); ?>");
}
}
<?php } else {} ?>

.sitelogoimg {
    display: block;
    position: relative;
}

@media only screen and (max-width:768px) {
	.sitelogoimg {
	background-size: 300px auto;
	width: 300px;
	height: <?php echo ( $height / 1.3 ); ?>px;

}
}

.row.header {
	background: url('<?php header_image(); ?>') #f0f0f0;
}


/* primary/secondary color options */

a { color: <?php echo of_get_option('clarity_primary_color','#6AA0FB'); ?>; }

a:visited { color: <?php echo of_get_option('clarity_primary_color','#6AA0FB'); ?>; }

a:hover,
a:focus,
a:active { color: <?php echo of_get_option('clarity_secondary_color','#3b83ff'); ?>; }

article:hover .entry-content .iconic, article:hover .row .iconic {
	background-color: <?php echo of_get_option('clarity_secondary_color','#3b83ff'); ?>;
}

article footer.entry-meta:hover .perma {
	color: <?php echo of_get_option('clarity_secondary_color','#3b83ff'); ?>;
}

.site-description {
	color: <?php echo of_get_option('clarity_secondary_color','#3b83ff'); ?>;
}

<?php }


// Omit closing PHP tag to be awesome