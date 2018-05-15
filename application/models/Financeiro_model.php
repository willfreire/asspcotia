<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Financeiro_model extends CI_Model {

    # Propriedades
    public $draw;
    public $orderBy;
    public $orderType;
    public $start;
    public $length;
    public $filter;
    public $columns;
    public $recordsTotal;
    public $recordsFiltered;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Método responsável por cadastrar / editar uma despesa
     *
     * @method setDespesa
     * @param obj $valores Dados para cadastro / edicao
     * @access public
     * @return obj Status de ação
     */
    public function setDespesa($valores)
    {
        # Atribuir vars
        $retorno = new stdClass();
        $dados   = array();

        $dados['ano']          = $valores->ano;
        $dados['vl_fix_final'] = str_replace(',', '.', str_replace('.', '', $valores->vl_fixado));
        $dados['vl_gasto']     = str_replace(',', '.', str_replace('.', '', $valores->vl_gasto));

        if (isset($valores->id) && $valores->id != ""):
            # Atualiza Despesa
            $this->db->where('id_despesa_pk', $valores->id);
            $this->db->update('tb_despesa', $dados);

            if ($this->db->affected_rows() >= 0) {
                $retorno->status = TRUE;
                $retorno->msg    = "Edi&ccedil;&atilde;o realizada com Sucesso!";
            } else {
                $retorno->status = FALSE;
                $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            }
        else:
            # Grava Despesa
            $this->db->insert('tb_despesa', $dados);

            if ($this->db->affected_rows() > 0) {
                $retorno->status = TRUE;
                $retorno->msg    = "Cadastro realizado com Sucesso!";
            } else {
                $retorno->status = FALSE;
                $retorno->msg    = "Houve um erro ao cadastrar! Tente novamente...";
            }
        endif;

        # retornar
        return $retorno;
    }

    /**
     * Método responsável por cadastrar / editar uma receita
     *
     * @method setReceita
     * @param obj $valores Dados para cadastro / edicao
     * @access public
     * @return obj Status de ação
     */
    public function setReceita($valores)
    {
        # Atribuir vars
        $retorno = new stdClass();
        $dados   = array();

        $dados['ano']           = $valores->ano;
        $dados['vl_previsto']   = str_replace(',', '.', str_replace('.', '', $valores->vl_previsto));
        $dados['vl_arrecadado'] = str_replace(',', '.', str_replace('.', '', $valores->vl_arrecadado));

        if (isset($valores->id) && $valores->id != ""):
            # Atualiza Receita
            $this->db->where('id_receita_pk', $valores->id);
            $this->db->update('tb_receita', $dados);

            if ($this->db->affected_rows() >= 0) {
                $retorno->status = TRUE;
                $retorno->msg    = "Edi&ccedil;&atilde;o realizada com Sucesso!";
            } else {
                $retorno->status = FALSE;
                $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            }
        else:
            # Grava Receita
            $this->db->insert('tb_receita', $dados);

            if ($this->db->affected_rows() > 0) {
                $retorno->status = TRUE;
                $retorno->msg    = "Cadastro realizado com Sucesso!";
            } else {
                $retorno->status = FALSE;
                $retorno->msg    = "Houve um erro ao cadastrar! Tente novamente...";
            }
        endif;

        # retornar
        return $retorno;
    }

    /**
     * Método responsável por pesquisar e buscar Despesas
     *
     * @method getDespesas
     * @param obj $search Conjuntos de dados para realizar a pesquisa
     * @access public
     * @return obj Lista de despesas
     */
    public function getDespesas($search)
    {
        # Atribuir valores
        $this->draw      = $search->draw;
        $this->orderBy   = $search->orderBy;
        $this->orderType = $search->orderType;
        $this->start     = $search->start;
        $this->length    = $search->length;
        $this->filter    = $search->filter;
        $this->columns   = $search->columns;
        $filter          = array();
        $where           = array();

        # Se houver busca pela grid
        if ($this->filter != NULL):
            for($i=0; $i<count($this->columns); $i++):
                if ($this->columns[$i]['searchable'] === "true"):
                    $column = $this->columns[$i]['data'];
                    $filter[]= "$column LIKE '%{$this->filter}%'";
                endif;
            endfor;
        endif;

        # Contar total de registros
        $this->db->select('COUNT(id_despesa_pk) AS total');
        $this->db->from('tb_despesa');
        if (!empty($filter)):
            $where = implode(" OR ", $filter);
            $this->db->where($where);
        endif;
        $query            = $this->db->get();
        $respRecordsTotal = $query->result();
        if (!empty($respRecordsTotal)):
            $this->recordsTotal = $respRecordsTotal[0]->total;
        else:
            $this->recordsTotal = 0;
        endif;

        # Consultar financeiros
        $this->db->select('id_despesa_pk, ano, vl_fix_final, vl_gasto');
        $this->db->from('tb_despesa');
        if (!empty($filter)):
            $where = implode(" OR ", $filter);
            $this->db->where($where);
        endif;
        $this->db->order_by($this->orderBy, $this->orderType);
        $this->db->limit($this->length, $this->start);
        $query_dados = $this->db->get();
        $resp_dados  = $query_dados->result();

        # Criar classe predefinida
        $despes = array();
        if (!empty($resp_dados)):

            foreach ($resp_dados as $value):
                # Botao
                $id_despesa = $value->id_despesa_pk;
                $url_edit   = base_url('./admin/financeiro/despesa_editar/'.$id_despesa);
                $url_view   = base_url('./admin/financeiro/despesa_ver/'.$id_despesa);
                $acao       = "<button type='button' class='btn btn-success btn-xs btn-acao' title='Editar Despesa' onclick='Financeiro.redirect(\"$url_edit\")'><i class='glyphicon glyphicon-edit' aria-hidden='true'></i></button>";
                $acao      .= "<button type='button' class='btn btn-warning btn-xs btn-acao' title='Visualizar Despesa' onclick='Financeiro.redirect(\"$url_view\")'><i class='glyphicon glyphicon-eye-open' aria-hidden='true'></i></button>";
                $acao      .= "<button type='button' class='btn btn-danger btn-xs btn-acao' title='Excluir Despesa' onclick='Financeiro.delDespesa(\"$id_despesa\")'><i class='glyphicon glyphicon-remove' aria-hidden='true'></i></button>";

                $vl_fixado = isset($value->vl_fix_final) && $value->vl_fix_final != "0.00" ? "R\$ ".number_format($value->vl_fix_final, 2, ',', '.') : "R\$ 0,00";
                $vl_gasto  = isset($value->vl_gasto) && $value->vl_gasto != "0.00" ? "R\$ ".number_format($value->vl_gasto, 2, ',', '.') : "R\$ 0,00";

                $desp               = new stdClass();
                $desp->ano          = $value->ano;
                $desp->vl_fix_final = $vl_fixado;
                $desp->vl_gasto     = $vl_gasto;
                $desp->acao         = $acao;
                $despes[]           = $desp;
            endforeach;

        endif;

        $dados['draw']            = intval($this->draw);
        $dados['recordsTotal']    = $this->recordsTotal;
        $dados['recordsFiltered'] = $this->recordsTotal;
        $dados['data']            = $despes;

        return $dados;
    }

    /**
     * Método responsável por pesquisar e buscar Receitas
     *
     * @method getReceitas
     * @param obj $search Conjuntos de dados para realizar a pesquisa
     * @access public
     * @return obj Lista de receitas
     */
    public function getReceitas($search)
    {
        # Atribuir valores
        $this->draw      = $search->draw;
        $this->orderBy   = $search->orderBy;
        $this->orderType = $search->orderType;
        $this->start     = $search->start;
        $this->length    = $search->length;
        $this->filter    = $search->filter;
        $this->columns   = $search->columns;
        $filter          = array();
        $where           = array();

        # Se houver busca pela grid
        if ($this->filter != NULL):
            for($i=0; $i<count($this->columns); $i++):
                if ($this->columns[$i]['searchable'] === "true"):
                    $column = $this->columns[$i]['data'];
                    $filter[]= "$column LIKE '%{$this->filter}%'";
                endif;
            endfor;
        endif;

        # Contar total de registros
        $this->db->select('COUNT(id_receita_pk) AS total');
        $this->db->from('tb_receita');
        if (!empty($filter)):
            $where = implode(" OR ", $filter);
            $this->db->where($where);
        endif;
        $query            = $this->db->get();
        $respRecordsTotal = $query->result();
        if (!empty($respRecordsTotal)):
            $this->recordsTotal = $respRecordsTotal[0]->total;
        else:
            $this->recordsTotal = 0;
        endif;

        # Consultar receitas
        $this->db->select('id_receita_pk, ano, vl_previsto, vl_arrecadado');
        $this->db->from('tb_receita');
        if (!empty($filter)):
            $where = implode(" OR ", $filter);
            $this->db->where($where);
        endif;
        $this->db->order_by($this->orderBy, $this->orderType);
        $this->db->limit($this->length, $this->start);
        $query_dados = $this->db->get();
        $resp_dados  = $query_dados->result();

        # Criar classe predefinida
        $receitas = array();
        if (!empty($resp_dados)):

            foreach ($resp_dados as $value):
                # Botao
                $id_receita = $value->id_receita_pk;
                $url_edit   = base_url('./admin/financeiro/receita_editar/'.$id_receita);
                $url_view   = base_url('./admin/financeiro/receita_ver/'.$id_receita);
                $acao       = "<button type='button' class='btn btn-success btn-xs btn-acao' title='Editar Receita' onclick='Financeiro.redirect(\"$url_edit\")'><i class='glyphicon glyphicon-edit' aria-hidden='true'></i></button>";
                $acao      .= "<button type='button' class='btn btn-warning btn-xs btn-acao' title='Visualizar Receita' onclick='Financeiro.redirect(\"$url_view\")'><i class='glyphicon glyphicon-eye-open' aria-hidden='true'></i></button>";
                $acao      .= "<button type='button' class='btn btn-danger btn-xs btn-acao' title='Excluir Receita' onclick='Financeiro.delReceita(\"$id_receita\")'><i class='glyphicon glyphicon-remove' aria-hidden='true'></i></button>";

                $vl_previsto   = isset($value->vl_previsto) && $value->vl_previsto != "0.00" ? "R\$ ".number_format($value->vl_previsto, 2, ',', '.') : "R\$ 0,00";
                $vl_arrecadado = isset($value->vl_arrecadado) && $value->vl_arrecadado != "0.00" ? "R\$ ".number_format($value->vl_arrecadado, 2, ',', '.') : "R\$ 0,00";

                $receita                = new stdClass();
                $receita->ano           = $value->ano;
                $receita->vl_previsto   = $vl_previsto;
                $receita->vl_arrecadado = $vl_arrecadado;
                $receita->acao          = $acao;
                $receitas[]             = $receita;
            endforeach;

        endif;

        $dados['draw']            = intval($this->draw);
        $dados['recordsTotal']    = $this->recordsTotal;
        $dados['recordsFiltered'] = $this->recordsTotal;
        $dados['data']            = $receitas;

        return $dados;
    }

    /**
     * Método de exclusão de uma Despesa
     *
     * @method delDespesa
     * @access public
     * @param integer $id Id do registro a ser excluído
     * @return obj Status da ação
     */
    public function delDespesa($id)
    {
        # Atribuir vars
        $retorno = new stdClass();

        # SQL
        $this->db->where('id_despesa_pk', $id);
        $this->db->delete('tb_despesa');

        if ($this->db->affected_rows() > 0) {
            $retorno->status = TRUE;
            $retorno->msg    = "Exclus&atilde;o realizada com Sucesso!";
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao Excluir! Tente novamente...";
        }

        # retornar
        return $retorno;
    }

    /**
     * Método de exclusão de uma Receita
     *
     * @method delReceita
     * @access public
     * @param integer $id Id do registro a ser excluído
     * @return obj Status da ação
     */
    public function delReceita($id)
    {
        # Atribuir vars
        $retorno = new stdClass();

        # SQL
        $this->db->where('id_receita_pk', $id);
        $this->db->delete('tb_receita');

        if ($this->db->affected_rows() > 0) {
            $retorno->status = TRUE;
            $retorno->msg    = "Exclus&atilde;o realizada com Sucesso!";
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao Excluir! Tente novamente...";
        }

        # retornar
        return $retorno;
    }
}

/* End of file financeiro_model.php */
/* Location: ./application/models/financeiro_model.php */