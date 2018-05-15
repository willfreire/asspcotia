<?php
# Dados do Noticia
$id     = isset($noticia[0]->id_noticia_pk) ? $noticia[0]->id_noticia_pk : "";
$titulo = isset($noticia[0]->titulo) ? $noticia[0]->titulo : "";
$img    = isset($noticia[0]->img) ? $noticia[0]->img : "";
$notic  = isset($noticia[0]->noticia) ? $noticia[0]->noticia : "";
$status = isset($noticia[0]->status) ? $noticia[0]->status : "";
?>

<style>
    .box-footer {
        background-color: transparent;
    }
</style>

<body class="hold-transition skin-green-light sidebar-mini">

    <!-- CSS Noticia -->
    <link rel="stylesheet" href="<?= base_url('assets/css/noticia.css') ?>">

    <!-- JS Noticia -->
    <script src="<?= base_url('scripts/js/noticia.js?cache=').time() ?>"></script>

    <div class="wrapper">

        <!-- Menu -->
        <?php require_once(APPPATH.'views/admin/menu.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Visualiza&ccedil;&atilde;o de Not&iacute;cia
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= base_url('./admin/main/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?= base_url('./admin/noticia') ?>"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Not&iacute;cias</a>
                    </li>
                    <li class="active">Visualizar</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">

                    <div class="col-xs-12">

                        <div class="box box-wrapper-80">

                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>T&iacute;tulo</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$titulo?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Imagem Principal</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10">
                                        <img src="<?=base_url('assets/imgs/noticias/'.$img)?>" style="width: 200px;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Not&iacute;cia</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10" style="overflow: auto"><?=$notic?></div>
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
