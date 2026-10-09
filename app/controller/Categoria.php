<?php

class Categoria extends BaseController
{
    public function index()
    {
        return $this->view("admin/listaCategoria");
    }
}