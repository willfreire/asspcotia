<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Estrutura_model extends CI_Model {

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
     * Método responsável por cadastrar / editar Presidencia
     *
     * @method setPresidencia
     * @param obj $valores Dados para cadastro / edicao
     * @access public
     * @return obj Status de ação
     */
    public function setPresidencia($valores)
    {
        # Atribuir vars
        $retorno = new stdClass();
        $dados   = array();

        $dados['presidente']      = $valores->presidente;
        $dados['vice_presidente'] = $valores->vice;

        if (isset($valores->id) && $valores->id != ""):
            # Atualiza
            $this->db->where('id_presidencia_pk', $valores->id);
            $this->db->update('tb_presidencia', $dados);

            if ($this->db->affected_rows() >= 0) {
                $retorno->status = TRUE;
                $retorno->msg    = "Edi&ccedil;&atilde;o realizada com Sucesso!";
            } else {
                $retorno->status = FALSE;
                $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            }
        else:
            # Grava
            $this->db->insert('tb_presidencia', $dados);

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
     * Método responsável por cadastrar / editar Secretaria
     *
     * @method setSecretaria
     * @param obj $valores Dados para cadastro / edicao
     * @access public
     * @return obj Status de ação
     */
    public function setSecretaria($valores)
    {
        # Atribuir vars
        $retorno = new stdClass();
        $dados   = array();

        $dados['st_secretario'] = $valores->st_secretario;
        $dados['rd_secretario'] = $valores->rd_secretario;

        if (isset($valores->id) && $valores->id != ""):
            # Atualiza
            $this->db->where('id_secretaria_pk', $valores->id);
            $this->db->update('tb_secretaria', $dados);

            if ($this->db->affected_rows() >= 0) {
                $retorno->status = TRUE;
                $retorno->msg    = "Edi&ccedil;&atilde;o realizada com Sucesso!";
            } else {
                $retorno->status = FALSE;
                $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            }
        else:
            # Grava
            $this->db->insert('tb_secretaria', $dados);

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
     * Método responsável por cadastrar / editar Conselho Fiscal
     *
     * @method setConselho
     * @param obj $valores Dados para cadastro / edicao
     * @access public
     * @return obj Status de ação
     */
    public function setConselho($valores)
    {
        # Atribuir vars
        $retorno = new stdClass();
        $dados   = array();

        $dados['conselheiro'] = $valores->conselheiro;
        $dados['suplente']    = $valores->suplente;

        if (isset($valores->id) && $valores->id != ""):
            # Atualiza
            $this->db->where('id_cons_fiscal_pk', $valores->id);
            $this->db->update('tb_cons_fiscal', $dados);

            if ($this->db->affected_rows() >= 0) {
                $retorno->status = TRUE;
                $retorno->msg    = "Edi&ccedil;&atilde;o realizada com Sucesso!";
            } else {
                $retorno->status = FALSE;
                $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            }
        else:
            # Grava
            $this->db->insert('tb_cons_fiscal', $dados);

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
     * Método responsável por pesquisar e buscar Conselho Fiscal
     *
     * @method getConselho
     * @param obj $search Conjuntos de dados para realizar a pesquisa
     * @access public
     * @return obj Lista de conselheiros
     */
    public function getConselho($search)
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
                    if ($column == "suplente" && strtolower($this->filter) == "sim") {
                        $this->filter = "s";
                    } elseif ($column == "suplente" && strtolower($this->filter) == "não") {
                        $this->filter = "n";
                    }
                    $filter[]= "$column LIKE '%{$this->filter}%'";
                endif;
            endfor;
        endif;

        # Contar total de registros
        $this->db->select('COUNT(id_cons_fiscal_pk) AS total');
        $this->db->from('tb_cons_fiscal');
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

        # Consultar
        $this->db->select("id_cons_fiscal_pk, conselheiro, CASE suplente WHEN 's' THEN 'Sim' WHEN 'n' THEN 'Não' END AS suplente", FALSE);
        $this->db->from('tb_cons_fiscal');
        if (!empty($filter)):
            $where = implode(" OR ", $filter);
            $this->db->where($where);
        endif;
        $this->db->order_by($this->orderBy, $this->orderType);
        $this->db->limit($this->length, $this->start);
        $query_dados = $this->db->get();
        $resp_dados  = $query_dados->result();

        # Criar classe predefinida
        $conses = array();
        if (!empty($resp_dados)):

            foreach ($resp_dados as $value):
                # Botao
                $id_conselho = $value->id_cons_fiscal_pk;
                $url_edit    = base_url('./admin/estrutura/conselho_editar/'.$id_conselho);
                $url_view    = base_url('./admin/estrutura/conselho_ver/'.$id_conselho);
                $acao        = "<button type='button' class='btn btn-success btn-xs btn-acao' title='Editar Conselheiro' onclick='Estrutura.redirect(\"$url_edit\")'><i class='glyphicon glyphicon-edit' aria-hidden='true'></i></button>";
                $acao       .= "<button type='button' class='btn btn-warning btn-xs btn-acao' title='Visualizar Conselheiro' onclick='Estrutura.redirect(\"$url_view\")'><i class='glyphicon glyphicon-eye-open' aria-hidden='true'></i></button>";
                $acao       .= "<button type='button' class='btn btn-danger btn-xs btn-acao' title='Excluir Conselheiro' onclick='Estrutura.delConselho(\"$id_conselho\")'><i class='glyphicon glyphicon-remove' aria-hidden='true'></i></button>";

                $conse              = new stdClass();
                $conse->conselheiro = $value->conselheiro;
                $conse->suplente    = $value->suplente;
                $conse->acao        = $acao;
                $conses[]           = $conse;
            endforeach;

        endif;

        $dados['draw']            = intval($this->draw);
        $dados['recordsTotal']    = $this->recordsTotal;
        $dados['recordsFiltered'] = $this->recordsTotal;
        $dados['data']            = $conses;

        return $dados;
    }

    /**
     * Método de exclusão de um Conselho Fiscal
     *
     * @method delConselho
     * @access public
     * @param integer $id Id do registro a ser excluído
     * @return obj Status da ação
     */
    public function delConselho($id)
    {
        # Atribuir vars
        $retorno = new stdClass();

        # SQL
        $this->db->where('id_cons_fiscal_pk', $id);
        $this->db->delete('tb_cons_fiscal');

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
     * Método responsável por pesquisar e buscar Socio
     *
     * @method getSocio
     * @param obj $search Conjuntos de dados para realizar a pesquisa
     * @access public
     * @return obj Lista de socios
     */
    public function getSocio($search)
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
        $this->db->select('COUNT(id_socio_pk) AS total');
        $this->db->from('tb_socio');
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

        # Consultar
        $this->db->select('id_socio_pk, socio');
        $this->db->from('tb_socio');
        if (!empty($filter)):
            $where = implode(" OR ", $filter);
            $this->db->where($where);
        endif;
        $this->db->order_by($this->orderBy, $this->orderType);
        $this->db->limit($this->length, $this->start);
        $query_dados = $this->db->get();
        $resp_dados  = $query_dados->result();

        # Criar classe predefinida
        $socios = array();
        if (!empty($resp_dados)):

            foreach ($resp_dados as $value):
                # Botao
                $id_socio  = $value->id_socio_pk;
                $url_edit  = base_url('./admin/estrutura/socio_editar/'.$id_socio);
                $url_view  = base_url('./admin/estrutura/socio_ver/'.$id_socio);
                $acao      = "<button type='button' class='btn btn-success btn-xs btn-acao' title='Editar S&oacute;cio' onclick='Estrutura.redirect(\"$url_edit\")'><i class='glyphicon glyphicon-edit' aria-hidden='true'></i></button>";
                $acao     .= "<button type='button' class='btn btn-warning btn-xs btn-acao' title='Visualizar S&oacute;cio' onclick='Estrutura.redirect(\"$url_view\")'><i class='glyphicon glyphicon-eye-open' aria-hidden='true'></i></button>";
                $acao     .= "<button type='button' class='btn btn-danger btn-xs btn-acao' title='Excluir S&oacute;cio' onclick='Estrutura.delSocio(\"$id_socio\")'><i class='glyphicon glyphicon-remove' aria-hidden='true'></i></button>";

                $socio        = new stdClass();
                $socio->socio = $value->socio;
                $socio->acao  = $acao;
                $socios[]     = $socio;
            endforeach;

        endif;

        $dados['draw']            = intval($this->draw);
        $dados['recordsTotal']    = $this->recordsTotal;
        $dados['recordsFiltered'] = $this->recordsTotal;
        $dados['data']            = $socios;

        return $dados;
    }

    /**
     * Método responsável por cadastrar / editar Socio
     *
     * @method setSocio
     * @param obj $valores Dados para cadastro / edicao
     * @access public
     * @return obj Status de ação
     */
    public function setSocio($valores)
    {
        # Atribuir vars
        $retorno = new stdClass();
        $dados   = array();

        $dados['socio'] = $valores->socio;

        if (isset($valores->id) && $valores->id != ""):
            # Atualiza
            $this->db->where('id_socio_pk', $valores->id);
            $this->db->update('tb_socio', $dados);

            if ($this->db->affected_rows() >= 0) {
                $retorno->status = TRUE;
                $retorno->msg    = "Edi&ccedil;&atilde;o realizada com Sucesso!";
            } else {
                $retorno->status = FALSE;
                $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            }
        else:
            # Grava
            $this->db->insert('tb_socio', $dados);

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
     * Método de exclusão de um Socio
     *
     * @method delSocio
     * @access public
     * @param integer $id Id do registro a ser excluído
     * @return obj Status da ação
     */
    public function delSocio($id)
    {
        # Atribuir vars
        $retorno = new stdClass();

        # SQL
        $this->db->where('id_socio_pk', $id);
        $this->db->delete('tb_socio');

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

/* End of file estrutura_model.php */
/* Location: ./application/models/estrutura_model.php */