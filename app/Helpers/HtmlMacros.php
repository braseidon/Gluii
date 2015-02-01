<?php namespace App\Helpers;

use HTML;
use URL;

/**
 * Backend - Navigation Menu Links
 * {{ HTML::liLinkNav('routeName', 'Link Text') }}
 *
 * @return string
 * @uses  HTML::linkRoute
 */
HTML::macro('liLinkNav', function($name, $title = null, $parameters = array(), $attributes = array())
{
	$active = (URL::current() == URL::route($name)) ? ' class="active"':'';

	return '<li' . $active . '>' . htmlspecialchars_decode(HTML::linkRoute($name, '<i class="i i-dot"></i><span> ' . $title . '</span>', $parameters, $attributes)) . '</li>';
});

/**
 * Frontend - <li> links with auto-active
 *
 * @return string
 */
HTML::macro('liLinkRoute', function($name, $title = null, $parameters = array(), $attributes = array()){
	$active = ( URL::current() == URL::route($name, $parameters) ) ? ' class="active"':'';
	return '<li'.$active.'>' . HTML::linkRoute($name, $title, $parameters, $attributes) . '</li>';
});