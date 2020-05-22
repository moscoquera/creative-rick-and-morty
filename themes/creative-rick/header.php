<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rick_And_Morty
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site container">

    <div id="header" class="row header">
        <div class="col">
            <img src="<?php echo get_template_directory_uri().'/assets/rick-and-morty-bg.png' ?>" class="ram-header-backgroud" />
            <div class="header-filter"></div>
            <div class="header-text">
                <p class="header-title">RICK & MORTY</p>
                <p class="header-sub">I’m sorry, but your opinion means very little to me</p>
                <div class="header-line"></div>

                <div class="header-search">
                    <input type="search" placeholder="Search Ricks & Morties" id="search_txt" />
                    <button role="button" type="button" id="search_btn" class="search-btn" ><svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23.926 27.68C25.9579 27.68 27.605 26.0329 27.605 24.001C27.605 21.9691 25.9579 20.322 23.926 20.322C21.8942 20.322 20.247 21.9691 20.247 24.001C20.247 26.0329 21.8942 27.68 23.926 27.68Z" fill="#92622A"/>
                            <path d="M43.328 22.198H42.23H38.521H36.832H33.122V25.801H37.34H38.521H42.23H43.473H47.84V22.198H43.328Z" fill="#92622A"/>
                            <path d="M27.604 38.223V42.01C34.807 40.545 40.476 34.885 41.94 27.68H38.153C36.821 32.844 32.765 36.889 27.604 38.223Z" fill="#92622A"/>
                            <path d="M22.085 37.033V38.59V42.305V44.006V47.916H25.689V44.236V42.307V38.604V36.879V33.201H22.085V37.033Z" fill="#92622A"/>
                            <path d="M9.70702 27.68H5.91202C7.37602 34.881 13.04 40.555 20.245 42.018V38.225C15.085 36.893 11.039 32.838 9.70702 27.68Z" fill="#92622A"/>
                            <path d="M10.971 25.801H14.878V22.198H10.55H9.329H5.619H4.493H0.160004V25.801H3.768H5.619H9.329H10.971Z" fill="#92622A"/>
                            <path d="M20.246 9.784V5.989C13.042 7.452 7.376 13.117 5.91 20.322H9.697C11.028 15.159 15.085 11.115 20.246 9.784Z" fill="#92622A"/>
                            <path d="M25.726 13.153V9.405V5.695V4.568V0.0830002H22.124V3.993V5.695V9.405V11.66V14.802H25.726V13.153Z" fill="#92622A"/>
                            <path d="M38.152 20.322H41.939C40.477 13.117 34.806 7.452 27.603 5.989V9.784C32.765 11.115 36.821 15.159 38.152 20.322Z" fill="#92622A"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

    </div>

