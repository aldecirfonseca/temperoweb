<?php

class Chef extends AdminController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = $this->model("Chef");
    }

    public function index()
    {
        return $this->view("admin/listaChef", ["rows" => $this->model->lista()]);
    }

    public function form()
    {
        return $this->view("admin/formChef", [
            "dados" => $this->registroDoFormulario($this->model)
        ]);
    }

    public function insert()
    {
        $this->exigePost();

        $dados = $this->dadosDoPost();

        try {
            $dados['imagem'] = $this->trataImagem('chef');
        } catch (RuntimeException $ex) {
            $this->redirect('msgError', $ex->getMessage());
        }

        $id = $this->model->insert($dados);

        if ($id > 0) {
            $this->redirect('msgSucesso', 'Chef cadastrado com sucesso!');
        } else {
            $this->redirect('msgError', 'Não foi possível cadastrar o Chef.');
        }
    }

    public function update()
    {
        $this->exigePost();

        $id    = (int)$this->request->post('id');
        $atual = $this->model->getById($id);

        if (empty($atual)) {
            $this->redirect('msgError', 'Registro não encontrado.');
        }

        $dados = $this->dadosDoPost();

        try {
            $dados['imagem'] = $this->trataImagem('chef', $atual['imagem']);
        } catch (RuntimeException $ex) {
            $this->redirect('msgError', $ex->getMessage());
        }

        $this->model->update($id, $dados);

        $this->redirect('msgSucesso', 'Chef alterado com sucesso!');
    }

    public function delete()
    {
        $this->exigePost();

        $id    = (int)$this->request->post('id');
        $atual = $this->model->getById($id);

        if ($this->model->delete($id) > 0) {
            $this->upload->remover($atual['imagem'] ?? null, 'chef');
            $this->redirect('msgSucesso', 'Chef excluído com sucesso!');
        } else {
            $this->redirect('msgError', 'Não foi possível excluir o Chef.');
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
            'nome'           => $this->request->post('nome'),
            'cargo'          => $this->request->post('cargo'),
            'bio'            => $this->request->post('bio'),
            'statusRegistro' => ($this->request->post('statusRegistro') == '2' ? 2 : 1),
        ];

        if ($dados['nome'] == "" || $dados['cargo'] == "" || $dados['bio'] == "") {
            $this->redirect('msgError', 'Informe o nome, o cargo e a apresentação do chef.');
        }

        return $dados;
    }
}
