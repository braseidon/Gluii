<?php

/*
|---------------------------
| Bootstrap & UI
|---------------------------
|
|
*/

/**
 * Button loading state
 *
 * @return string
 */
function btnLoading()
{
	return 'data-loading-text="Loading..."';
}

/**
 * Adds HTML for a Bootrstrap 3 tooltip
 *
 * @param  string $text
 * @return string
 */
function tooltip($text, $position = null)
{
	if(! is_null($position) && in_array($position, ['top', 'right', 'bottom', 'left']))
		$position = 'data-placement="' . $position . '"';

	return 'data-toggle="tooltip" ' . $position . ' data-original-title="' . e($text) . '" title="' . e($text) . '"';
}

/**
 * Adds the HTML for a popover, and replaces quotes with single quotes
 *
 * @param  string $content
 * @param  string $placement
 * @return string
 */
function popover($content, $placement = 'top')
{
	return 'data-container="body" data-toggle="popover" data-html="true" data-placement="' . $placement . '" data-content="' . str_replace('"', '\'', $content) . '"';
}

/**
 * Returns an icon that's a popover which displays help text
 *
 * @param  string $content
 * @param  string $position
 * @return string
 */
function helpIcon($content, $position = 'top')
{
	return '<a href="javascript:void(0);" class="fa fa-info-circle text-muted" ' . tooltip($content, $position) . '></a>';
}