<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage BASSEIN
 * @since BASSEIN 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('bassein_storage_get')) {
	function bassein_storage_get($var_name, $default='') {
		global $BASSEIN_STORAGE;
		return isset($BASSEIN_STORAGE[$var_name]) ? $BASSEIN_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('bassein_storage_set')) {
	function bassein_storage_set($var_name, $value) {
		global $BASSEIN_STORAGE;
		$BASSEIN_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('bassein_storage_empty')) {
	function bassein_storage_empty($var_name, $key='', $key2='') {
		global $BASSEIN_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($BASSEIN_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($BASSEIN_STORAGE[$var_name][$key]);
		else
			return empty($BASSEIN_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('bassein_storage_isset')) {
	function bassein_storage_isset($var_name, $key='', $key2='') {
		global $BASSEIN_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($BASSEIN_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($BASSEIN_STORAGE[$var_name][$key]);
		else
			return isset($BASSEIN_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('bassein_storage_inc')) {
	function bassein_storage_inc($var_name, $value=1) {
		global $BASSEIN_STORAGE;
		if (empty($BASSEIN_STORAGE[$var_name])) $BASSEIN_STORAGE[$var_name] = 0;
		$BASSEIN_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('bassein_storage_concat')) {
	function bassein_storage_concat($var_name, $value) {
		global $BASSEIN_STORAGE;
		if (empty($BASSEIN_STORAGE[$var_name])) $BASSEIN_STORAGE[$var_name] = '';
		$BASSEIN_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('bassein_storage_get_array')) {
	function bassein_storage_get_array($var_name, $key, $key2='', $default='') {
		global $BASSEIN_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($BASSEIN_STORAGE[$var_name][$key]) ? $BASSEIN_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($BASSEIN_STORAGE[$var_name][$key][$key2]) ? $BASSEIN_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('bassein_storage_set_array')) {
	function bassein_storage_set_array($var_name, $key, $value) {
		global $BASSEIN_STORAGE;
		if (!isset($BASSEIN_STORAGE[$var_name])) $BASSEIN_STORAGE[$var_name] = array();
		if ($key==='')
			$BASSEIN_STORAGE[$var_name][] = $value;
		else
			$BASSEIN_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('bassein_storage_set_array2')) {
	function bassein_storage_set_array2($var_name, $key, $key2, $value) {
		global $BASSEIN_STORAGE;
		if (!isset($BASSEIN_STORAGE[$var_name])) $BASSEIN_STORAGE[$var_name] = array();
		if (!isset($BASSEIN_STORAGE[$var_name][$key])) $BASSEIN_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$BASSEIN_STORAGE[$var_name][$key][] = $value;
		else
			$BASSEIN_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('bassein_storage_merge_array')) {
	function bassein_storage_merge_array($var_name, $key, $value) {
		global $BASSEIN_STORAGE;
		if (!isset($BASSEIN_STORAGE[$var_name])) $BASSEIN_STORAGE[$var_name] = array();
		if ($key==='')
			$BASSEIN_STORAGE[$var_name] = array_merge($BASSEIN_STORAGE[$var_name], $value);
		else
			$BASSEIN_STORAGE[$var_name][$key] = array_merge($BASSEIN_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('bassein_storage_set_array_after')) {
	function bassein_storage_set_array_after($var_name, $after, $key, $value='') {
		global $BASSEIN_STORAGE;
		if (!isset($BASSEIN_STORAGE[$var_name])) $BASSEIN_STORAGE[$var_name] = array();
		if (is_array($key))
			bassein_array_insert_after($BASSEIN_STORAGE[$var_name], $after, $key);
		else
			bassein_array_insert_after($BASSEIN_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('bassein_storage_set_array_before')) {
	function bassein_storage_set_array_before($var_name, $before, $key, $value='') {
		global $BASSEIN_STORAGE;
		if (!isset($BASSEIN_STORAGE[$var_name])) $BASSEIN_STORAGE[$var_name] = array();
		if (is_array($key))
			bassein_array_insert_before($BASSEIN_STORAGE[$var_name], $before, $key);
		else
			bassein_array_insert_before($BASSEIN_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('bassein_storage_push_array')) {
	function bassein_storage_push_array($var_name, $key, $value) {
		global $BASSEIN_STORAGE;
		if (!isset($BASSEIN_STORAGE[$var_name])) $BASSEIN_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($BASSEIN_STORAGE[$var_name], $value);
		else {
			if (!isset($BASSEIN_STORAGE[$var_name][$key])) $BASSEIN_STORAGE[$var_name][$key] = array();
			array_push($BASSEIN_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('bassein_storage_pop_array')) {
	function bassein_storage_pop_array($var_name, $key='', $defa='') {
		global $BASSEIN_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($BASSEIN_STORAGE[$var_name]) && is_array($BASSEIN_STORAGE[$var_name]) && count($BASSEIN_STORAGE[$var_name]) > 0) 
				$rez = array_pop($BASSEIN_STORAGE[$var_name]);
		} else {
			if (isset($BASSEIN_STORAGE[$var_name][$key]) && is_array($BASSEIN_STORAGE[$var_name][$key]) && count($BASSEIN_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($BASSEIN_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('bassein_storage_inc_array')) {
	function bassein_storage_inc_array($var_name, $key, $value=1) {
		global $BASSEIN_STORAGE;
		if (!isset($BASSEIN_STORAGE[$var_name])) $BASSEIN_STORAGE[$var_name] = array();
		if (empty($BASSEIN_STORAGE[$var_name][$key])) $BASSEIN_STORAGE[$var_name][$key] = 0;
		$BASSEIN_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('bassein_storage_concat_array')) {
	function bassein_storage_concat_array($var_name, $key, $value) {
		global $BASSEIN_STORAGE;
		if (!isset($BASSEIN_STORAGE[$var_name])) $BASSEIN_STORAGE[$var_name] = array();
		if (empty($BASSEIN_STORAGE[$var_name][$key])) $BASSEIN_STORAGE[$var_name][$key] = '';
		$BASSEIN_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('bassein_storage_call_obj_method')) {
	function bassein_storage_call_obj_method($var_name, $method, $param=null) {
		global $BASSEIN_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($BASSEIN_STORAGE[$var_name]) ? $BASSEIN_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($BASSEIN_STORAGE[$var_name]) ? $BASSEIN_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('bassein_storage_get_obj_property')) {
	function bassein_storage_get_obj_property($var_name, $prop, $default='') {
		global $BASSEIN_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($BASSEIN_STORAGE[$var_name]->$prop) ? $BASSEIN_STORAGE[$var_name]->$prop : $default;
	}
}
?>