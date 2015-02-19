<?php namespace App\Helpers;

use HTML;
use URL;

/**
 * Sidebar Navigation Menu Links
 * {{ HTML::liLinkNav('routeName', 'Link Text') }}
 *
 * @return string
 * @uses  HTML::linkRoute
 */
HTML::macro('liLinkNav', function ($name, $title = null, $parameters = [], $attributes = []) {
    $active = (URL::current() == URL::route($name)) ? ' class="active"':'';

    return '<li' . $active . '>' . htmlspecialchars_decode(HTML::linkRoute($name, '<i class="i i-dot"></i><span> ' . $title . '</span>', $parameters, $attributes)) . '</li>';
});

/**
 * Sub Navigation Menu Links
 * {{ HTML::liIconLink('routeName', 'Link Text', 'icon icon-user') }}
 *
 * @return string
 * @uses  HTML::liIconLink
 */
HTML::macro('liIconLink', function ($name, $title = null, $icon = null, $iconRight = false, $parameters = [], $attributes = []) {
    $active = (URL::current() == URL::route($name)) ? ' class="active"':'';

    if ($icon !== null) {
        $icon = '<i class="' . $icon . ' fa-fw m-r-xs"></i> ';
    }

    if ($iconRight !== false) {
        $iconRight = '<i class="fa fa-angle-right pull-right m-t-xs text-xs icon-muted"></i> ';
    }

    return '<li' . $active . '>' . htmlspecialchars_decode(HTML::linkRoute($name, $iconRight . $icon . $title, $parameters, $attributes)) . '</li>';
});

/**
 * Sub Navigation Menu Links
 * {{ HTML::liLinkSubNav('routeName', 'Link Text', 'icon icon-user') }}
 *
 * @return string
 * @uses  HTML::liLinkSubNav
 */
HTML::macro('liLinkSubNav', function ($name, $title = null, $icon = null, $parameters = [], $attributes = []) {
    $active = (URL::current() == URL::route($name)) ? ' class="active"':'';

    if ($icon !== null) {
        $icon = '<i class="' . $icon . ' fa-fw m-r-xs"></i> ';
    }

    return '<li' . $active . '>' . htmlspecialchars_decode(HTML::linkRoute($name, '<i class="fa fa-angle-right pull-right m-t-xs text-xs icon-muted"></i> ' . $icon . $title, $parameters, $attributes)) . '</li>';
});

/**
 * Frontend - <li> links with auto-active
 *
 * @return string
 */
HTML::macro('liLinkRoute', function ($name, $title = null, $parameters = [], $attributes = []) {
    $active = (URL::current() == URL::route($name, $parameters)) ? ' class="active"':'';
    return '<li'.$active.'>' . HTML::linkRoute($name, $title, $parameters, $attributes) . '</li>';
});
