<?php

class Home extends BaseController
{
    public function index()
    {
        $CategoriaModel = $this->model('categoria');
        $aCategoria = $CategoriaModel->lista();

        return $this->view(
            "home",
            [
                'aCategoria' => $aCategoria
            ]
        );
    }

    public function quemSomos()
    {
        return $this->view('quemsomos');
    }

    public function menu()
    {
        return $this->view('menu');
    }

    public function chef()
    {
        return $this->view('chef');
    }

    public function blog()
    {
        return $this->view('blog');
    }

    public function faleConosco()
    {
        return $this->view('faleConosco');
    }
}