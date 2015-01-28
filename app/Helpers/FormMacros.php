<?php

$errors = Session::get('errors', new Illuminate\Support\MessageBag);

/**
 * Wrap a return value in a form-group
 * Form::group('key', 'Label', $horizontal = true, function($name)
 * {
 *  	return Form::something();
 * })
 *
 * @var boolean
 */
Form::macro('group', function($name, $label, $horizontal = true, $callback) use ($errors)
{
	$output = '<div class="form-group' . ($errors->has($name) ? ' has-error' : '') . '">';
	$output .= '<label class="control-label' . (! $horizontal ? '' : ' col-md-4 col-lg-3') . '">' . $label . '</label>';
	$output .= (! $horizontal ? '' : '<div class="col-md-8 col-lg-9">');
	$output .= $callback($name);
	$output .= $errors->first($name, '<span class="help-block">:message</span>');
	$output .= (! $horizontal ? '' : '</div>');
	$output .= '</div>';

	return $output;
});