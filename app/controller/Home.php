<?php

/**
 * Home
 *
 * Páginas públicas do site. Os dados agora vêm do banco (via models);
 * os textos institucionais (hero, quem somos) continuam nas views.
 */
class Home extends BaseController
{
    public function index()
    {
        return $this->view("home", [
            "aDestaque" => $this->model("Produto")->destaques()
        ]);
    }

    public function quemSomos()
    {
        return $this->view("quemSomos");
    }

    public function menu()
    {
        $ProdutoModel = $this->model("Produto");

        return $this->view("menu", [
            "aDestaque" => $ProdutoModel->destaques(),
            "aCardapio" => $ProdutoModel->cardapio()
        ]);
    }

    public function chef()
    {
        return $this->view("chef", [
            "aChef" => $this->model("Chef")->listaAtivos()
        ]);
    }

    public function blog()
    {
        return $this->view("blog", [
            "aNoticia"       => $this->model("Noticia")->publicadas(),
            "aCategoriaBlog" => $this->model("BlogCategoria")->comQuantidade()
        ]);
    }

    public function reserva()
    {
        $this->model("Reserva");    // carrega a classe para usar as constantes

        return $this->view("reserva", [
            "aHorario"      => ReservaModel::HORARIOS,
            "maximoPessoas" => ReservaModel::MAXIMO_PESSOAS
        ]);
    }

    public function faleConosco()
    {
        return $this->view("faleConosco");
    }

    /**
     * enviarReserva
     *
     * Recebe o formulário "Reservar mesa" (POST) e grava como Pendente.
     *
     * @return void
     */
    public function enviarReserva()
    {
        $this->exigePost();

        $ReservaModel = $this->model("Reserva");

        $dados = [
            'nome'       => $this->request->post('nome'),
            'email'      => $this->request->post('email'),
            'telefone'   => $this->request->post('telefone'),
            'data'       => $this->request->post('data'),
            'horario'    => $this->request->post('horario'),
            'pessoas'    => (int)$this->request->post('pessoas'),
            'observacao' => $this->request->post('observacao'),
            'situacao'   => 1,   // Pendente: a equipe confirma pelo admin
        ];

        $erro = $ReservaModel->valida($dados);

        if ($erro != "") {
            $this->redirect('msgError', $erro, 'Home/reserva');
        }

        $ReservaModel->insert($dados);

        $this->redirect(
            'msgSucesso',
            'Reserva recebida! Vamos confirmar pelo telefone ou e-mail informado.',
            'Home/reserva'
        );
    }

    /**
     * enviarContato
     *
     * Recebe o formulário "Fale conosco" (POST).
     *
     * @return void
     */
    public function enviarContato()
    {
        $this->exigePost();

        $ContatoModel = $this->model("Contato");

        $dados = [
            'nome'     => $this->request->post('nome'),
            'telefone' => $this->request->post('telefone'),
            'email'    => $this->request->post('email'),
            'mensagem' => $this->request->post('mensagem'),
        ];

        $erro = $ContatoModel->valida($dados);

        if ($erro != "") {
            $this->redirect('msgError', $erro, 'Home/faleConosco');
        }

        $ContatoModel->insert($dados);

        $this->redirect(
            'msgSucesso',
            'Mensagem enviada! Respondemos em até 1 dia útil.',
            'Home/faleConosco'
        );
    }
}
