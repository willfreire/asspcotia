<?php
# Dados do Parceria
$id        = isset($parceria[0]->id_parceria_pk) ? $parceria[0]->id_parceria_pk : "";
$categ     = isset($parceria[0]->id_categoria_fk) ? $parceria[0]->id_categoria_fk : "";
$nome      = isset($parceria[0]->nome) ? $parceria[0]->nome : "";
$img       = isset($parceria[0]->img) ? $parceria[0]->img : "";
$descricao = isset($parceria[0]->descricao) ? $parceria[0]->descricao : "";
$status    = isset($parceria[0]->id_status_fk) ? $parceria[0]->id_status_fk : "";
?>

<body class="hold-transition skin-green-light sidebar-mini">

    <!-- CSS Parceria -->
    <link rel="stylesheet" href="<?=base_url('assets/css/parceria.css')?>">

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
                    Edi&ccedil;&atilde;o de Parceria
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= base_url('./admin/main/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?= base_url('./admin/parceria') ?>"><i class="fa fa-users" aria-hidden="true"></i> Parcerias</a>
                    </li>
                    <li class="active">Editar</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">

                    <div class="col-xs-12">

                        <div class="container-fluid box box-primary" id="box-frm-parceria">

                            <div class="box-header with-border">
                                <span class="text-danger">*</span> Campo com preenchimento obrigat&oacute;rio
                            </div>
                            
                            <form role="form" name="frm_edit_parceria" id="frm_edit_parceria" enctype="multipart/form-data">

                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-5">
                                                <label for="categoria">Categoria<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <select class="form-control" name="categoria" id="categoria" required="true">
                                                        <option value="">Selecione</option>
                                                        <?php 
                                                            if (is_array($categorias)):
                                                                foreach ($categorias as $value):
                                                                    $sel = $categ == $value->id_categoria_pk ? "selected" : "";
                                                                    echo "<option value='$value->id_categoria_pk' $sel>$value->categoria</option>";
                                                                endforeach;
                                                            endif;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                <label for="nome">Nome<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" maxlength="200" required="true" value="<?=$nome?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                <label for="img">Imagem<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <?php if ($img != "") :?>
                                                    <img src="<?=base_url('assets/imgs/parcerias/'.$img)?>" style="width: 150px;">
                                                    <?php endif; ?>
                                                    <input type="hidden" name="img_anexo" id="img_anexo" value="<?=$img?>">
                                                    <input type="file" class="form-control" id="img" name="img" placeholder="Selecione..." accept=".jpg, .jpeg, .png">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                <label for="descricao">Descri&ccedil;&atilde;o</label>
                                                <div class="controls">
                                                    <textarea class="form-control" id="descricao" name="descricao" placeholder="Descri&ccedil;&atilde;o" maxlength="10000" rows="5"><?=$descricao?></textarea>
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
                                    <input type="hidden" id="id_parceria" name="id_parceria" value="<?=$id?>">
                                    <button type="submit" id="btn_edit_parceria" name="btn_edit_parceria" class="btn btn-success">Alterar</button>
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
