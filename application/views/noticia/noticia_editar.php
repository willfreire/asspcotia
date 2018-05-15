<?php
# Dados do Noticia
$id     = isset($noticia[0]->id_noticia_pk) ? $noticia[0]->id_noticia_pk : "";
$titulo = isset($noticia[0]->titulo) ? $noticia[0]->titulo : "";
$img    = isset($noticia[0]->img) ? $noticia[0]->img : "";
$notic  = isset($noticia[0]->noticia) ? $noticia[0]->noticia : "";
$status = isset($noticia[0]->id_status_fk) ? $noticia[0]->id_status_fk : "";
?>

<body class="hold-transition skin-green-light sidebar-mini">

    <!-- CSS Noticia -->
    <link rel="stylesheet" href="<?=base_url('assets/css/noticia.css')?>">

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
                    Edi&ccedil;&atilde;o de Not&iacute;cia
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= base_url('./admin/main/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?= base_url('./admin/noticia') ?>"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Not&iacute;cias</a>
                    </li>
                    <li class="active">Editar</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">

                    <div class="col-xs-12">

                        <div class="container-fluid box box-primary" id="box-frm-noticia">

                            <div class="box-header with-border">
                                <span class="text-danger">*</span> Campo com preenchimento obrigat&oacute;rio
                            </div>
                            
                            <form role="form" name="frm_edit_noticia" id="frm_edit_noticia" enctype="multipart/form-data">

                                <div class="box-body">

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                <label for="titulo">T&iacute;tulo<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="T&iacute;tulo" maxlength="200" required="true" value="<?=$titulo?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                <label for="img">Imagem Principal<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <?php if ($img != "") :?>
                                                    <img src="<?=base_url('assets/imgs/noticias/'.$img)?>" style="width: 150px;">
                                                    <?php endif; ?>
                                                    <input type="hidden" name="img_anexo" id="img_anexo" value="<?=$img?>">
                                                    <input type="file" class="form-control" id="img" name="img" placeholder="Selecione..." accept=".jpg, .jpeg, .png">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <label for="noticia">Not&iacute;cia</label>
                                                <div class="controls">
                                                    <textarea class="form-control" id="noticia" name="noticia" placeholder="Not&iacute;cia"><?=$notic?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-5">
                                                <label for="status">Status<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" id="status" value="1" <?=$status == "1" ? "checked='checked'" : ""?>> <div class="radio-position">Ativo</div>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" id="status" value="2" <?=$status == "2" ? "checked='checked'" : ""?>> <div class="radio-position">Inativo</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <input type="hidden" id="id_noticia" name="id_noticia" value="<?=$id?>">
                                    <button type="submit" id="btn_edit_noticia" name="btn_edit_noticia" class="btn btn-success">Alterar</button>
                                    <button type="button" id="btn_back" name="btn_back" class="btn btn-primary">Voltar</button>
                                </div>
                            </form>

                        </div>

                    </div>

                </div>
            </section>

        </div>
        <!-- /.content-wrapper -->

    </div>
