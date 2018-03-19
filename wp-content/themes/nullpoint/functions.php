<?php

/********** NULLPOINT DEFINITION *************/
if ( ! isset( $content_width ) ) $content_width = 1200;
$npt_includes_path 		= get_template_directory() . '/includes/';

/********** END NULLPOINT DEFINITION *************/

//Theme init
require_once $npt_includes_path . 'theme-init.php';

//Sidebar
require_once $npt_includes_path . 'theme-sidebar.php';

//Additional function
require_once $npt_includes_path . 'theme-function.php';

//Header function
require_once $npt_includes_path . 'header-function.php';

//Loading jQuery
require_once $npt_includes_path . 'theme-scripts.php';

//Loading Style Css
require_once $npt_includes_path . 'theme-styles.php';

//TGM-Plugin-Activation
require_once $npt_includes_path . 'class-tgm-plugin-activation.php';

require_once $npt_includes_path . 'child-plugins.php';

//About Theme
require_once $npt_includes_path . 'about-theme.php';

define('NULLPOINT_WEBZAKT_THEME_URL','https://webzakt.com/nullpoint-wordpress-portfolio-themes/','nullpoint');
define('NULLPOINT_WEBZAKT_AUTHOR_URL','http://webzakt.com/','nullpoint');
define('NULLPOINT_WEBZAKT_THEME_DOC','http://webzakt.com/docs/','nullpoint');