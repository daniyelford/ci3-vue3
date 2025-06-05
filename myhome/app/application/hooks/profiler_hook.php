<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function enable_profiler_hook() {
    $CI =& get_instance();
    $CI->output->enable_profiler(TRUE);
}
