<?php

/**
 * Laravel.io community wiki skin.
 *
 * @file
 * @ingroup Skins
 * @author Jason Lewis <me@jasonlewis.me>
 * @license 2-clause BSD
 */

if( ! defined( 'MEDIAWIKI' ))
{
	die('Stop trying to run this skin, fool!');
}
 
$wgExtensionCredits['skin'][] = array(
    'path'			 => __FILE__,
    'name'			 => 'Laravel',
    'url'			 => '[http://laravel.io Laravel.io]',
    'author'		 => '[http://jasonlewis.me Jason Lewis]',
    'descriptionmsg' => 'laravel-desc',
);

$wgValidSkinNames['laravel-io-wiki-skin'] = 'Laravel';
$wgAutoloadClasses['SkinLaravel'] = __DIR__.'/Laravel.skin.php';
$wgExtensionMessagesFiles['Laravel'] = __DIR__.'/Laravel.i18n.php';
 
$wgResourceModules['skins.laravel-io-wiki-skin'] = array(
	'styles' => array(
    	'laravel-io-wiki-skin/assets/stylesheets/webfonts.css' => array('media' => 'screen'),
    	'laravel-io-wiki-skin/assets/stylesheets/font-awesome.css' => array('media' => 'screen'),
    	'laravel-io-wiki-skin/assets/stylesheets/normalize.css' => array('media' => 'screen'),
    	'laravel-io-wiki-skin/assets/stylesheets/main.css' => array('media' => 'screen')
    ),
    'remoteBasePath' => &$GLOBALS['wgStylePath'],
    'localBasePath' => &$GLOBALS['wgStyleDirectory']
);