<?php

class Home extends BaseController
{
    public function index()
    {
        return $this->view("home", ['data', ["id" => 100, 'descricao' => "Teste view"]]);
    }
}