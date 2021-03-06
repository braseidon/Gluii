<?php namespace App\Helpers;

use Form;
use Illuminate\Support\MessageBag;
use Session;

$errors = Session::get('errors', new MessageBag);

/**
 * Wrap a return value in a form-group
 * Form::group('key', 'Label', $cols = true, function($name)
 * {
 *      return Form::something();
 * })
 *
 * @var boolean
 */
Form::macro('group', function ($name, $label = false, $why = false, callable $callback) use ($errors) {
    $output = '<div class="form-group' . ($errors->has($name) ? ' has-error' : '') . '">';
    $output .= '<label class="control-label">' . $label . '</label>';
    $output .= $callback($name);
    $output .= $errors->first($name, '<span class="help-block">:message</span>');
    $output .= '</div>';

    return $output;
});

/**
 * Open a Form-Group
 * Form::groupOpen('form_key', 'Label')
 *
 * @var boolean
 */
Form::macro('groupOpen', function ($name, $label = null) use ($errors) {
    $output = '<div class="form-group' . ($errors->has($name) ? ' has-error' : '') . '">';
    if ($label !== null) {
        $output .= '<label class="control-label">' . $label . '</label>';
    }

    return $output;
});

/**
 * Close a Form-Group
 * Form::groupClose('form_key' 'help-block txt')
 *
 * @var boolean
 */
Form::macro('groupClose', function ($name, $helpblock = null) use ($errors) {
    $output = '';
    if ($helpblock !== null) {
        $output .= '<span class="help-block">' . $helpblock . '</span>';
    }
    $output .= $errors->first($name, '<span class="help-block">:message</span>');
    $output .= '</div>';

    return $output;
});

/**
 * Wrap a return value in a form-group
 * Form::group('key', 'Label', $cols = true, function($name)
 * {
 *      return Form::something();
 * })
 *
 * @var boolean
 */
Form::macro('groupHorizontal', function ($name, $label = false, $cols = [3, 9], callable $callback) use ($errors) {
    if (is_array($cols) && count($cols) == 2) {
        $cols        = array_values($cols);
        $labelCols    = ' col-md-' . ($cols[0] + 1) . ' col-lg-' . $cols[0];
        $divCols    = ' col-md-' . ($cols[1] - 1) . ' col-lg-' . $cols[1];
    }

    $output = '<div class="form-group' . ($errors->has($name) ? ' has-error' : '') . '">';
    $output .= ! $label ? '' : '<label class="control-label' . (! $cols ? '' : $labelCols) . '">' . $label . '</label>';
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
Form::macro('iCheckbox', function ($name, $label, $value = 1, $checked = false, $options = array()) {
    $output = '<div class="checkbox">';
    $output .= '<label class="i-checks">';
    $output .= Form::checkbox($name, 1, $checked);
    $output .= '<i></i> ' . $label;
    $output .= '</label>';
    $output .= '</div>';

    return $output;
});
