<?php

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