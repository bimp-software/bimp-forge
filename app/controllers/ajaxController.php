<?php

use Bimp\Forge\Controller;

class ajaxController extends Controller {
    
    private $r_type = null;
    private $hook = null;
    private $action = null;
    private $csrf = null;
    private $datas = null;
    private $hook_name = 'bimp_hook';

    private $accepted_actions = ['get','post','put','delete','options','add','load','login'];
    private $required_params  = ['hook','action'];

    function __construct(){ 
        foreach($this->required_params as $param) {
            if(!isset($_POST[$param])) {
                json_output(json_build(403));
            }
        }

        if(!in_array($_POST['action'], $this->accepted_actions)) {
            json_output(json_build(403));
        }
    }


}