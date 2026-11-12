<?php

class Categoria extends AdminController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = $this->model("Categoria");
    }

    public function index()
    {
        return $this->view("admin/listaCategoria", ["rows" => $this->model->lista()]);
    }

    public function form()
    {
        return $this->view("admin/formCategoria", [
            "dados" => $this->registroDoFormulario($this->model)
        ]);
    }

    public function insert()
    {
        $this->exigePost();

        $id = $this->model->insert($this->dadosDoPost());

        if ($id > 0) {
            $this->redirect('msgSucesso', 'Categoria cadastrada com sucesso!');
        } else {
            $this->redirect('msgError', 'Não foi possível cadastrar a Categoria.');
        }
    }

    public function update()
    {
        $this->exigePost();

        // Sem exceção = gravou. (rowCount() devolve 0 quando nada mudou,
        // então não serve para dizer se o update deu certo.)
        $this->model->update((int)$this->request->post('id'), $this->dadosDoPost());

        $this->redirect('msgSucesso', 'Categoria alterada com sucesso!');
    }

    public function delete()
    {
        $this->exigePost();

        try {
            $linhas = $this->model->delete((int)$this->request->post('id'));
        } catch (PDOException $ex) {
            if ($this->ehErroDeChaveEstrangeira($ex)) {
                $this->redirect('msgError', 'Esta categoria tem produtos e não pode ser excluída. Altere o status para Inativo.');
            }
            throw $ex;
        }

        if ($linhas > 0) {
            $this->redirect('msgSucesso', 'Categoria excluída com sucesso!');
        } else {
            $this->redirect('msgError', 'Não foi possível excluir a Categoria.');
        }
    }

    /**
     * dadosDoPost
     *
     * Lê e valida o formulário. É private: não responde pela URL.
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
