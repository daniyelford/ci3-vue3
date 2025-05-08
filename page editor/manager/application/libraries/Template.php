<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#
#       CodeIgniter Template Engine
#
#       @author         Phu Qui Le <lephuqui@gmail.com>
#       @package        Template class
#       @version        1.2
#       @since          08/25/2012
#       @files          Template.php
#
#       INSTALLATION
#
#       1. Copy Template.php and Modules.php into application/libraries
#       2. Autoload it in application/config/autoload.php
#
#       *****************************************************************
#       *       $autoload['libraries'] = array('template');             *
#       *****************************************************************

class Template {
                var $template_data = array();
                var $layout = "_layout";
                var $CI = null;
                
                function __construct() {
                        $this->CI =& get_instance();
                }
                
                function __set($name, $value)
                {
                        $this->template_data[$name] = $value;
                }
        
                function __get($name)
                {
                        if (array_key_exists($name, $this->template_data)) {
                                return $this->template_data[$name];
                        }
                }
        
                function __isset($name)
                {
                        return isset($this->template_data[$name]);
                }
        
                function __unset($name)
                {
                        unset($this->template_data[$name]);
                }
                
                function __call($method, $args) {
                        
                        require_once(APPPATH.'controllers/modules/'.$method.EXT);       

                        # execute method
                        $mod_data = $method($args);
                        return $this->CI->load->view('modules/'.$method, $mod_data, TRUE);
                        
                }
                
                function parse_block($output) {
                        
                        if(preg_match('/<!-- #[\r\n]*(.*?)[\r\n]*-->/s', $output, $matches)) {
                                #       $matches[1] contains:
                                #
                                #               $this->title = "Welcome to CodeIgniter";
                                #               $this->layout = null;
                                #       
                                #       it will be execute when call eval() method.
                                eval($matches[1]);
                                
                                return preg_replace('/<!-- #[\r\n]*(.*?)[\r\n]*-->\r\n/s', '', $output, 1);
                        }
                        
                        return $output;
                }
                
                function load($view = '' , $view_data = array(), $return = FALSE)       {               
                        $output = $this->CI->load->view($view, $view_data, TRUE);       
                                
                                #       parse hidden code
                        $output = $this->parse_block($output);
                        
                                #       insert view into template if layout not null.
                        if($this->layout && $return == false) {
                                $this->contents = $output;
                                $output = $this->CI->load->view($this->layout, $this->template_data, TRUE);
                        }
                                #       auto parse modules if already exist.
                        // $output = preg_replace_callback('/<!-- #MOD (.*?)\((.*?)\) -->/se', create_function($matches,'$this->\\1("\\2");'), $output);
                        
                        if($return) return $output;
                        $this->CI->output->append_output($output);
                }
}

#       End of file Template.php
#       Location: /application/libraries/Template.php
?>