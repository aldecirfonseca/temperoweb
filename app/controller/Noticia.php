<?php

class Noticia extends AdminController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = $this->model("Noticia");
    }

    public function index()
    {
        return $this->view("admin/listaNoticia", ["rows" => $this->model->listaComCategoria()]);
    }

    public function form()
    {
        return $this->view("admin/formNoticia", [
            "dados"          => $this->registroDoFormulario($this->model),
            "aCategoriaBlog" => $this->model("BlogCategoria")->lista()
        ]);
    }

    public function insert()
    {
        $this->exigePost();

        $dados = $this->dadosDoPost();

        try {
            $dados['imagem'] = $this->trataImagem('noticia');
        } catch (RuntimeException $ex) {
            $this->redirect('msgError', $ex->getMessage());
        }

        $id = $this->model->insert($dados);

        if ($id > 0) {
            $this->redirect('msgSucesso', 'Notícia cadastrada com sucesso!');
        } else {
            $this->redirect('msgError', 'Não foi possível cadastrar a Notícia.');
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
            $dados['imagem'] = $this->trataImagem('noticia', $atual['imagem']);
        } catch (RuntimeException $ex) {
            $this->redirect('msgError', $ex->getMessage());
        }

        $this->model->update($id, $dados);

        $this->redirect('msgSucesso', 'Notícia alterada com sucesso!');
    }

    public function delete()
    {
        $this->exigePost();

        $id    = (int)$this->request->post('id');
        $atual = $this->model->getById($id);

        if ($this->model->delete($id) > 0) {
            $this->upload->remover($atual['imagem'] ?? null, 'noticia');
            $this->redirect('msgSucesso', 'Notícia excluída com sucesso!');
        } else {
            $this->redirect('msgError', 'Não foi possível excluir a Notícia.');
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
            'blog_categoria_id' => (int)$this->request->post('blog_categoria_id'),
            'titulo'            => $this->request->post('titulo'),
            'resumo'            => $this->request->post('resumo'),
            'dataPublicacao'    => $this->request->post('dataPublicacao'),
            'statusRegistro'    => ($this->request->post('statusRegistro') == '2' ? 2 : 1),
        ];

        if ($dados['blog_categoria_id'] <= 0) {
            $this->redirect('msgError', 'Selecione a categoria da notícia.');
        }

        if ($dados['titulo'] == "" || $dados['resumo'] == "") {
            $this->redirect('msgError', 'Informe o título e o resumo da notícia.');
        }

        $data = DateTime::createFromFormat('Y-m-d', $dados['dataPublicacao']);

        if ($data === false || $data->format('Y-m-d') !== $dados['dataPublicacao']) {
            $this->redirect('msgError', 'Informe uma data de publicação válida.');
        }

        return $dados;
    }
}
