<?php

class Produto extends AdminController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = $this->model("Produto");
    }

    public function index()
    {
        return $this->view("admin/listaProduto", ["rows" => $this->model->listaComCategoria()]);
    }

    public function form()
    {
        return $this->view("admin/formProduto", [
            "dados"      => $this->registroDoFormulario($this->model),
            "aCategoria" => $this->model("Categoria")->lista()
        ]);
    }

    public function insert()
    {
        $this->exigePost();

        $dados = $this->dadosDoPost();

        try {
            $dados['imagem'] = $this->trataImagem('produto');
        } catch (RuntimeException $ex) {
            $this->redirect('msgError', $ex->getMessage());
        }

        $id = $this->model->insert($dados);

        if ($id > 0) {
            $this->redirect('msgSucesso', 'Produto cadastrado com sucesso!');
        } else {
            $this->redirect('msgError', 'Não foi possível cadastrar o Produto.');
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
            $dados['imagem'] = $this->trataImagem('produto', $atual['imagem']);
        } catch (RuntimeException $ex) {
            $this->redirect('msgError', $ex->getMessage());
        }

        $this->model->update($id, $dados);

        $this->redirect('msgSucesso', 'Produto alterado com sucesso!');
    }

    public function delete()
    {
        $this->exigePost();

        $id    = (int)$this->request->post('id');
        $atual = $this->model->getById($id);

        if ($this->model->delete($id) > 0) {
            $this->upload->remover($atual['imagem'] ?? null, 'produto');
            $this->redirect('msgSucesso', 'Produto excluído com sucesso!');
        } else {
            $this->redirect('msgError', 'Não foi possível excluir o Produto.');
        }
    }

    /**
     * dadosDoPost
     *
     * @return array
     */
    private function dadosDoPost(): array
    {
        $tag = $this->request->post('tag');

        $dados = [
            'categoria_id'   => (int)$this->request->post('categoria_id'),
            'nome'           => $this->request->post('nome'),
            'descricao'      => $this->request->post('descricao'),
            'preco'          => strFloat($this->request->post('preco')),   // "1.234,50" -> 1234.5
            'tag'            => ($tag == "" ? null : $tag),
            'destaque'       => ($this->request->post('destaque') == '1' ? 1 : 0),
            'statusRegistro' => ($this->request->post('statusRegistro') == '2' ? 2 : 1),
        ];

        if ($dados['categoria_id'] <= 0) {
            $this->redirect('msgError', 'Selecione a categoria do produto.');
        }

        if ($dados['nome'] == "" || $dados['descricao'] == "") {
            $this->redirect('msgError', 'Informe o nome e a descrição do produto.');
        }

        if ($dados['preco'] <= 0) {
            $this->redirect('msgError', 'Informe um preço maior que zero.');
        }

        return $dados;
    }
}
