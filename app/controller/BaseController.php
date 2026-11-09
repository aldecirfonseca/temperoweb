<?php

/**
 * BaseController
 *
 * Classe mãe de todos os controllers. É "abstract": não pode ser
 * instanciada nem aberta pela URL, só herdada.
 *
 * Todos os métodos daqui são protected: o roteador (index.php) só executa
 * métodos públicos, então nenhum deles responde por uma URL.
 */
abstract class BaseController
{
    protected Request $request;

    public function __construct()
    {
        $this->request = new Request();

        // utilits: baseUrl(), menuAtivo()... usados no layout (cabecalho/rodapé)
        // crud: mensagens(), cabecalho()... usados nos formulários e no admin
        $this->helper(['utilits', 'crud']);
    }

    /**
     * view
     *
     * @param string $view
     * @param array $data
     * @return void
     */
    protected function view(string $view, array $data = [])
    {
        $data['action'] = $this->request->getAction();

        extract($this->escapa($data));
        require_once 'app/view/' . $view . '.php';
    }

    /**
     * escapa
     *
     * Aplica htmlspecialchars recursivamente em todos os valores string
     * do array (incluindo arrays aninhados, como os retornados por
     * Model::lista()), prevenindo XSS ao exibir dados nas views.
     *
     * @param array $dados
     * @return array
     */
    private function escapa(array $dados): array
    {
        foreach ($dados as $chave => $valor) {
            if (is_array($valor)) {
                $dados[$chave] = $this->escapa($valor);
            } elseif (is_string($valor)) {
                $dados[$chave] = htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
            }
        }

        return $dados;
    }

    /**
     * model
     *
     * Convenção: model('Produto') carrega e instancia app/model/ProdutoModel.php
     *
     * @param string $nomeModel
     * @return object
     */
    protected function model(string $nomeModel): object
    {
        $nomeModel = ucfirst($nomeModel) . 'Model';

        if (file_exists('app/model/' . $nomeModel . '.php')) {
            require_once 'app/model/' . $nomeModel . '.php';

            return new $nomeModel();
        }

        return (object)null;
    }

    /**
     * helper
     *
     * @param string|array $nomeHelper
     * @return void
     */
    protected function helper(string|array $nomeHelper)
    {
        // Se Helper for string, converte para array
        if (gettype($nomeHelper) == 'string') {
            $nomeHelper = [$nomeHelper];
        }

        foreach ($nomeHelper as $helper) {
            require_once 'app/helper/' . $helper . '.php';
        }
    }

    /**
     * redirect
     *
     * Redireciona e encerra a requisição (padrão Post/Redirect/Get).
     * A mensagem vai pela query string e é exibida por mensagens().
     *
     * @param string $tipoMsg   'msgSucesso', 'msgError' ou "" (sem mensagem)
     * @param string $mensagem
     * @param string $rota      destino; "" = index do controller atual
     * @return never
     */
    protected function redirect(string $tipoMsg, string $mensagem, string $rota = ""): never
    {
        $url = baseUrl() . ($rota == "" ? get_class($this) : $rota);

        if ($tipoMsg != "") {
            $url .= '?' . $tipoMsg . '=' . rawurlencode($mensagem);
        }

        header('Location: ' . $url);
        exit;
    }

    /**
     * exigePost
     *
     * Métodos que gravam dados (insert/update/delete) só aceitam POST.
     * Abrir /Categoria/delete direto na barra de endereço não apaga nada.
     *
     * @return void
     */
    protected function exigePost(): void
    {
        if (!$this->request->isPost()) {
            $this->redirect('msgError', 'Requisição inválida.');
        }
    }
}
