<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parceria_model extends CI_Model {

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
     * Método responsável por cadastrar / editar uma parceria
     *
     * @method setParceria
     * @param obj $valores Dados para cadastro / edicao
     * @access public
     * @return obj Status de ação
     */
    public function setParceria($valores)
    {
        # Atribuir vars
        $retorno = new stdClass();
        $dados   = array();

        $dados['parceria_url']    = convert_accented_characters(url_title($valores->nome, "dash", TRUE));
        $dados['id_categoria_fk'] = $valores->categoria;
        $dados['nome']            = $valores->nome;
        $dados['img']             = $valores->img;
        $dados['descricao']       = $valores->descricao;
        $dados['id_status_fk']    = $valores->status;

        if (isset($valores->id) && $valores->id != ""):
            # Atualiza parceria
            $this->db->where('id_parceria_pk', $valores->id);
            $this->db->update('tb_parceria', $dados);

            if ($this->db->affected_rows() >= 0) {
                $retorno->status = TRUE;
                $retorno->msg    = "Edi&ccedil;&atilde;o realizada com Sucesso!";
            } else {
                $retorno->status = FALSE;
                $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            }
        else:
            # Grava parceria
            $this->db->insert('tb_parceria', $dados);

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
     * Método responsável por pesquisar e buscar parcerias
     *
     * @method getParcerias
     * @param obj $search Conjuntos de dados para realizar a pesquisa
     * @access public
     * @return obj Lista de parcerias
     */
    public function getParcerias($search)
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
        $this->db->select('COUNT(p.id_parceria_pk) AS total');
        $this->db->from('tb_parceria p');
        $this->db->join('tb_categoria c', 'c.id_categoria_pk = p.id_categoria_fk', 'inner');
        $this->db->join('tb_status s', 's.id_status_pk = p.id_status_fk', 'inner');
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

        # Consultar parcerias
        $this->db->select('p.id_parceria_pk, c.categoria, p.nome, s.status');
        $this->db->from('tb_parceria p');
        $this->db->join('tb_categoria c', 'c.id_categoria_pk = p.id_categoria_fk', 'inner');
        $this->db->join('tb_status s', 's.id_status_pk = p.id_status_fk', 'inner');
        if (!empty($filter)):
            $where = implode(" OR ", $filter);
            $this->db->where($where);
        endif;
        $this->db->order_by($this->orderBy, $this->orderType);
        $this->db->limit($this->length, $this->start);
        $query_dados = $this->db->get();
        $resp_dados  = $query_dados->result();

        # Criar classe predefinida
        $parcs = array();
        if (!empty($resp_dados)):

            foreach ($resp_dados as $value):
                # Botao
                $id_parceria = $value->id_parceria_pk;
                $url_edit    = base_url('./admin/parceria/editar/'.$id_parceria);
                $url_view    = base_url('./admin/parceria/ver/'.$id_parceria);
                $acao        = "<button type='button' class='btn btn-success btn-xs btn-acao' title='Editar Parceria' onclick='Parceria.redirect(\"$url_edit\")'><i class='glyphicon glyphicon-edit' aria-hidden='true'></i></button>";
                $acao       .= "<button type='button' class='btn btn-warning btn-xs btn-acao' title='Visualizar Parceria' onclick='Parceria.redirect(\"$url_view\")'><i class='glyphicon glyphicon-eye-open' aria-hidden='true'></i></button>";
                $acao       .= "<button type='button' class='btn btn-danger btn-xs btn-acao' title='Excluir Parceria' onclick='Parceria.del(\"$id_parceria\")'><i class='glyphicon glyphicon-remove' aria-hidden='true'></i></button>";

                $parc            = new stdClass();
                $parc->categoria = $value->categoria;
                $parc->nome      = $value->nome;
                $parc->status    = $value->status;
                $parc->acao      = $acao;
                $parcs[]         = $parc;
            endforeach;

        endif;

        $dados['draw']            = intval($this->draw);
        $dados['recordsTotal']    = $this->recordsTotal;
        $dados['recordsFiltered'] = $this->recordsTotal;
        $dados['data']            = $parcs;

        return $dados;
    }

    /**
     * Método de exclusão de um Parceria
     *
     * @method delParceria
     * @access public
     * @param integer $id Id do registro a ser excluído
     * @return obj Status da ação
     */
    public function delParceria($id)
    {
        # Atribuir vars
        $retorno = new stdClass();

        # SQL
        $this->db->where('id_parceria_pk', $id);
        $this->db->delete('tb_parceria');

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

/* End of file parceria_model.php */
/* Location: ./application/models/parceria_model.php */