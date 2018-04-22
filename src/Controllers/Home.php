<?php

namespace Controllers;

class Home extends \Framework\Controller{

    public function GET_Index(){
       $this->renderView('home');
    }

}