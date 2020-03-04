<?php
function bp_base_url()
{
    return str_replace($_SERVER['DOCUMENT_ROOT'], '' , dirname(dirname(__FILE__)));
}

function bp_lib_url()
{
    return bp_base_url().'/Lib';
}

function bp_api_url()
{
    return bp_base_url().'/API';
}

function bp_logs_url()
{
    return bp_base_url().'/Logs';
}

function bp_plugin_url()
{
    return bp_base_url().'/Plugins';
}

function bp_theme_url()
{
    return bp_base_url().'/Themes';
}

function bp_language_url()
{
    return bp_base_url().'/Language';
}

function bp_config_url()
{
    return bp_base_url().'/Config';
}