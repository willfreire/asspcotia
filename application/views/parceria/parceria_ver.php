<?php
# Dados do Parceria
$id        = isset($parceria[0]->id_parceria_pk) ? $parceria[0]->id_parceria_pk : "";
$categ     = isset($parceria[0]->categoria) ? $parceria[0]->categoria : "";
$nome      = isset($parceria[0]->nome) ? $parceria[0]->nome : "";
$img       = isset($parceria[0]->img) ? $parceria[0]->img : "";
$descricao = isset($parceria[0]->descricao) ? $parceria[0]->descricao : "";
$status    = isset($parceria[0]->status) ? $parceria[0]->status : "";
?>

<style>
    .box-footer {
        background-color: transparent;
    }
</style>

<body class="hold-transition skin-green-light sidebar-mini">

    <!-- CSS Parceria -->
    <link rel="stylesheet" href="<?= base_url('assets/css/parceria.css') ?>">

    <!-- JS Parceria -->
    <script src="<?= base_url('scripts/js/parceria.js?cache=').time() ?>"></script>

    <div class="wrapper">

        <!-- Menu -->
        <?php require_once(APPPATH.'views/admin/menu.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Visualiza&ccedil;&atilde;o de Parceria
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= base_url('./admin/main/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?= base_url('./admin/parceria') ?>"><i class="fa fa-users" aria-hidden="true"></i> Parcerias</a>
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
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Categoria</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$categ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Nome</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$nome?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Imagem</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10">
                                        <img src="<?=base_url('assets/imgs/parcerias/'.$img)?>" style="width: 200px;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Descri&ccedil;&atilde;o</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10" style="overflow: auto"><?=$descricao?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Status</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$status?></div>
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
