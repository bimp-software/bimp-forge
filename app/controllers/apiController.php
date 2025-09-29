<?php

use Bimp\Forge\Routers\Controller;
use Bimp\Forge\Interfaces\IController;

class apiController extends Controller implements IController {

    function __construct() { parent::__construct('endpoint'); }
}