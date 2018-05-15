<?php
# Dados do Banner
$id       = isset($banner[0]->id_banner_pk) ? $banner[0]->id_banner_pk : "";
$img      = isset($banner[0]->img) ? $banner[0]->img : "";
$title    = isset($banner[0]->title) ? $banner[0]->title : "";
$subtitle = isset($banner[0]->subtitle) ? $banner[0]->subtitle : "";
$descript = isset($banner[0]->description) ? $banner[0]->description : "";
$btn_text = isset($banner[0]->btn_text) ? $banner[0]->btn_text : "";
$btn_link = isset($banner[0]->btn_link) ? $banner[0]->btn_link : "";
$pos_elem = isset($banner[0]->pos_elem) ? $banner[0]->pos_elem : "";
$status   = isset($banner[0]->status) ? $banner[0]->status : "";
?>

<style>
    .box-footer {
        background-color: transparent;
    }
</style>

<body class="hold-transition skin-green-light sidebar-mini">

    <!-- CSS Banner -->
    <link rel="stylesheet" href="<?= base_url('assets/css/banner.css') ?>">

    <!-- JS Banner -->
    <script src="<?= base_url('scripts/js/banner.js?cache=').time() ?>"></script>

    <div class="wrapper">

        <!-- Menu -->
        <?php require_once(APPPATH.'views/admin/menu.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Visualiza&ccedil;&atilde;o de Banner
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= base_url('./admin/main/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?= base_url('./admin/banner') ?>"><i class="fa fa-image" aria-hidden="true"></i> Banners</a>
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
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Imagem</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10">
                                        <img src="<?=base_url('assets/imgs/banners/'.$img)?>" style="width: 350px;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>T&iacute;tulo</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$title?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Subt&iacute;tulo</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$subtitle?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Descri&ccedil;&atilde;o</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10" style="overflow: auto"><?=$descript?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Link</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$btn_link?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Texto do Link</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$btn_text?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Alinhamento</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$pos_elem?></div>
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
