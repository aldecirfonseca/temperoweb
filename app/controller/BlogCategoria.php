<?php

class BlogCategoria extends AdminController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = $this->model("BlogCategoria");
    }

    public function index()
    {
        return $this->view("admin/listaBlogCategoria", ["rows" => $this->model->lista()]);
    }

    public function form()
    {
        return $this->view("admin/formBlogCategoria", [
            "dados" => $this->registroDoFormulario($this->model)
        ]);
    }

    public function insert()
    {
        $this->exigePost();

        $id = $this->model->insert($this->dadosDoPost());

        if ($id > 0) {
            $this->redirect('msgSucesso', 'Categoria do blog cadastrada com sucesso!');
        } else {
            $this->redirect('msgError', 'Não foi possível cadastrar a Categoria do blog.');
        }
    }

    public function update()
    {
        $this->exigePost();

        $this->model->update((int)$this->request->post('id'), $this->dadosDoPost());

        $this->redirect('msgSucesso', 'Categoria do blog alterada com sucesso!');
    }

    public function delete()
    {
        $this->exigePost();

        try {
            $linhas = $this->model->delete((int)$this->request->post('id'));
        } catch (PDOException $ex) {
            if ($this->ehErroDeChaveEstrangeira($ex)) {
                $this->redirect('msgError', 'Esta categoria tem notícias e não pode ser excluída. Altere o status para Inativo.');
            }
            throw $ex;
        }

        if ($linhas > 0) {
            $this->redirect('msgSucesso', 'Categoria do blog excluída com sucesso!');
        } else {
            $this->redirect('msgError', 'Não foi possível excluir a Categoria do blog.');
        }
    }

    /**
     * dadosDoPost
     *
     * @return array
     */
    private function dadosDoPost(): array
    {
        $dados = [
            'descricao'      => $this->request->post('descricao'),
            'statusRegistro' => ($this->request->post('statusRegistro') == '2' ? 2 : 1),
        ];

        if ($dados['descricao'] == "") {
            $this->redirect('msgError', 'Informe a descrição da categoria.');
        }

        return $dados;
    }
}
