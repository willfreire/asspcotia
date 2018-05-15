<?php
# Dados do Associado
$id       = isset($associado[0]->id_associado_req_pk) ? $associado[0]->id_associado_req_pk : "";
$nome     = isset($associado[0]->nome) ? $associado[0]->nome : "N&atilde;o Informado";
$cpf      = isset($associado[0]->cpf) ? $associado[0]->cpf : "N&atilde;o Informado";
$email    = isset($associado[0]->email) ? $associado[0]->email : "N&atilde;o Informado";
$telefone = isset($associado[0]->telefone) ? $associado[0]->telefone : "N&atilde;o Informado";
$endereco = isset($associado[0]->endereco) ? $associado[0]->endereco : "N&atilde;o Informado";
$num      = isset($associado[0]->num_endereco) ? ", {$associado[0]->num_endereco}" : "";
$bairro   = isset($associado[0]->bairro) ? $associado[0]->bairro : "N&atilde;o Informado";
$cep      = isset($associado[0]->cep) ? $associado[0]->cep : "N&atilde;o Informado";
$cidade   = isset($associado[0]->cidade) ? $associado[0]->cidade : "N&atilde;o Informado";
$estado   = isset($associado[0]->estado) ? $associado[0]->estado : "N&atilde;o Informado";
$dt       = isset($associado[0]->dt_solicitacao) ? date("d/m/Y H:i", strtotime($associado[0]->dt_solicitacao)) : "N&atilde;o Informado";
?>

<style>
    .box-footer {
        background-color: transparent;
    }
</style>

<body class="hold-transition skin-green-light sidebar-mini">

    <!-- CSS Associado -->
    <link rel="stylesheet" href="<?= base_url('assets/css/associado.css') ?>">

    <!-- JS Associado -->
    <script src="<?= base_url('scripts/js/associado.js?cache=').time() ?>"></script>

    <div class="wrapper">

        <!-- Menu -->
        <?php require_once(APPPATH.'views/admin/menu.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Visualiza&ccedil;&atilde;o de Associado
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= base_url('./admin/main/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?= base_url('./admin/associado/requerimento') ?>"><i class="fa fa-user-plus" aria-hidden="true"></i> Associados</a>
                    </li>
                    <li class="active">Visualizar</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">

                    <div class="col-xs-12">

                        <div class="box box-wrapper-50">

                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Data</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$dt?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Nome</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$nome?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>CPF</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$cpf?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>E-mail</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$email?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Telefone</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$telefone?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Endere&ccedil;o</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$endereco.$num?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Bairro</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$bairro?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>CEP</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$cep?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Cidade</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$cidade?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Estado</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$estado?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 text-center" style="padding: 0px;">
                                        <div class="box-footer">
                                            <button type="button" id="btn_back" name="btn_back" class="btn btn-primary">Voltar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>

                </div>
            </section>

        </div>
        <!-- /.content-wrapper -->

    </div>
