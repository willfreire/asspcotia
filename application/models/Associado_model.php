<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Associado_model extends CI_Model {

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
     * Método responsável por pesquisar e buscar associados
     *
     * @method getAssociados
     * @param obj $search Conjuntos de dados para realizar a pesquisa
     * @access public
     * @return obj Lista de associados
     */
    public function getAssociados($search)
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
        $this->db->select('COUNT(a.id_associado_req_pk) AS total');
        $this->db->from('tb_associado_req a');
        $this->db->join('tb_cidade c', 'c.id_cidade_pk = a.id_cidade_fk', 'inner');
        $this->db->join('tb_estado e', 'e.id_estado_pk = a.id_estado_fk', 'inner');
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

        # Consultar associados
        $this->db->select('a.id_associado_req_pk, a.nome, a.cpf, a.email, a.telefone, a.endereco, a.num_endereco, a.bairro,
                           a.cep, a.id_cidade_fk, a.id_estado_fk, a.dt_solicitacao, e.estado, e.sigla, c.cidade');
        $this->db->from('tb_associado_req a');
        $this->db->join('tb_cidade c', 'c.id_cidade_pk = a.id_cidade_fk', 'inner');
        $this->db->join('tb_estado e', 'e.id_estado_pk = a.id_estado_fk', 'inner');
        if (!empty($filter)):
            $where = implode(" OR ", $filter);
            $this->db->where($where);
        endif;
        $this->db->order_by($this->orderBy, $this->orderType);
        $this->db->limit($this->length, $this->start);
        $query_dados = $this->db->get();
        $resp_dados  = $query_dados->result();

        # Criar classe predefinida
        $assocs = array();
        if (!empty($resp_dados)):

            foreach ($resp_dados as $value):
                # Botao
                $id_associado = $value->id_associado_req_pk;
                # $url_edit     = base_url('./admin/associado/editar/'.$id_associado);
                $url_view     = base_url('./admin/associado/ver/'.$id_associado);
                # $acao         = "<button type='button' class='btn btn-success btn-xs btn-acao' title='Editar Associado' onclick='Associado.redirect(\"$url_edit\")'><i class='glyphicon glyphicon-edit' aria-hidden='true'></i></button>";
                $acao         = "<button type='button' class='btn btn-warning btn-xs btn-acao' title='Visualizar Associado' onclick='Associado.redirect(\"$url_view\")'><i class='glyphicon glyphicon-eye-open' aria-hidden='true'></i></button>";
                # $acao        .= "<button type='button' class='btn btn-danger btn-xs btn-acao' title='Excluir Associado' onclick='Associado.del(\"$id_associado\")'><i class='glyphicon glyphicon-remove' aria-hidden='true'></i></button>";

                $dt_solic = date("d/m/Y H:i", strtotime($value->dt_solicitacao));

                $assoc                 = new stdClass();
                $assoc->dt_solicitacao = $dt_solic;
                $assoc->nome           = $value->nome;
                $assoc->cpf            = $value->cpf;
                $assoc->email          = $value->email;
                $assoc->telefone       = $value->telefone;
                $assoc->acao           = $acao;
                $assocs[]              = $assoc;
            endforeach;

        endif;

        $dados['draw']            = intval($this->draw);
        $dados['recordsTotal']    = $this->recordsTotal;
        $dados['recordsFiltered'] = $this->recordsTotal;
        $dados['data']            = $assocs;

        return $dados;
    }
}

/* End of file associado_model.php */
/* Location: ./application/models/associado_model.php */