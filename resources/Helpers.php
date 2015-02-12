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

/*
|---------------------------
| Form Select Macros
|---------------------------
|
|
*/

/**
 * Returns an array meant for form selects
 *
 * @param  string $type
 * @return array
 */
function formFill($type)
{
	if($type == 'years')
		return array_combine(range(2015, 1905), range(2015, 1905));

	if($type == 'months')
		return [
			'01'	=> 'January',
			'02'	=> 'February',
			'03'	=> 'March',
			'04'	=> 'April',
			'05'	=> 'May',
			'06'	=> 'June',
			'07'	=> 'July',
			'08'	=> 'August',
			'09'	=> 'September',
			'10'	=> 'October',
			'11'	=> 'November',
			'12'	=> 'December',
		];

	if($type == 'days')
		return array_combine(range(1, 31), range(1, 31));
}