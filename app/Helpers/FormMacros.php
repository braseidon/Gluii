<?php

$errors = Session::get('errors', new Illuminate\Support\MessageBag);

/**
 * Wrap a return value in a form-group
 * Form::group('key', 'Label', $cols = true, function($name)
 * {
 *  	return Form::something();
 * })
 *
 * @var boolean
 */
Form::macro('group', function($name, $label, $cols = [3, 9], callable $callback) use ($errors)
{
	if(is_array($cols) && count($cols) == 2)
	{
		$cols		= array_values($cols);
		$labelCols	= ' col-md-' . ($cols[0] + 1) . ' col-lg-' . $cols[0];
		$divCols	= ' col-md-' . ($cols[1] - 1) . ' col-lg-' . $cols[1];
	}

	$output = '<div class="form-group' . ($errors->has($name) ? ' has-error' : '') . '">';
	$output .= '<label class="control-label' . (! $cols ? '' : $labelCols) . '">' . $label . '</label>';
	$output .= (! $cols ? '' : '<div class="' . $divCols . '">');
	$output .= $callback($name);
	$output .= $errors->first($name, '<span class="help-block">:message</span>');
	$output .= (! $cols ? '' : '</div>');
	$output .= '</div>';

	return $output;
});

/**
 * Checkbox using i-checks
 * Form::iCheckbox($name, $label, $value = 1, $checked = null, $options = array())
 *
 * @var integer
 */
Form::macro('iCheckbox', function($name, $label, $value = 1, $checked = null, $options = array())
{
	$output = '<div class="checkbox">';
	$output .= '<label class="i-checks">';
	$output .= Form::checkbox($name, 1, false);
	$output .= '<i></i> ' . $label;
	$output .= '</label>';
	$output .= '</div>';

	return $output;
});