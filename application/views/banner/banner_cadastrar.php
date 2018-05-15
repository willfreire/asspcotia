<body class="hold-transition skin-green-light sidebar-mini">

    <!-- CSS Banner -->
    <link rel="stylesheet" href="<?=base_url('assets/css/banner.css')?>">

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
                    Cadastro de Banner
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= base_url('./admin/main/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?= base_url('./admin/banner') ?>"><i class="fa fa-image" aria-hidden="true"></i> Banners</a>
                    </li>
                    <li class="active">Cadastrar</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">

                    <div class="col-xs-12">

                        <div class="container-fluid box box-primary" id="box-frm-banner">

                            <div class="box-header with-border">
                                <span class="text-danger">*</span> Campo com preenchimento obrigat&oacute;rio
                            </div>

                            <form role="form" name="frm_cad_banner" id="frm_cad_banner" enctype="multipart/form-data">

                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                <label for="img">Imagem<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <input type="file" class="form-control" id="img" name="img" placeholder="Selecione..." required="true" accept=".jpg, .jpeg, .png">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                <label for="titulo">T&iacute;tulo<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="T&iacute;tulo" maxlength="100" required="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                <label for="subtitulo">Subt&iacute;tulo</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" id="subtitulo" name="subtitulo" placeholder="Subt&iacute;tulo" maxlength="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                <label for="descricao">Descri&ccedil;&atilde;o</label>
                                                <div class="controls">
                                                    <textarea class="form-control" id="descricao" name="descricao" placeholder="Descri&ccedil;&atilde;o" maxlength="250" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
                                                <label for="btn_link">Link</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" id="btn_link" name="btn_link" placeholder="Link" maxlength="150">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
                                                <label for="btn_text">Texto do Link</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" id="btn_text" name="btn_text" placeholder="Texto do Link" maxlength="50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-5">
                                                <label for="pos_elem">Alinhamento do Texto<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="pos_elem" id="pos_elem" value="text-left"> <div class="radio-position">&Agrave; Esquerda</div>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="pos_elem" id="pos_elem" value="text-center"> <div class="radio-position">Centralizado</div>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="pos_elem" id="pos_elem" value="text-right"> <div class="radio-position">&Agrave; Direita</div>
                                                    </label>
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
                                                        <input type="radio" name="status" id="status" value="1"> <div class="radio-position">Ativo</div>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" id="status" value="2"> <div class="radio-position">Inativo</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <button type="submit" id="btn_cad_banner" name="btn_cad_banner" class="btn btn-success">Cadastrar</button>
                                    <button type="reset" id="limpar" name="limpar" class="btn btn-primary">Limpar</button>
                                </div>
                            </form>

                        </div>

                    </div>

                </div>
            </section>

        </div>
        <!-- /.content-wrapper -->

    </div>