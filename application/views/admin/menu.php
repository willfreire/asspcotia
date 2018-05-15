<header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url('./admin/main/dashboard') ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini" title="ASSPCOTIA">
            <img src="<?= base_url('assets/imgs/logotipo_asspcotia_50x50.jpg') ?>" alt="Logo ASSPCOTIA" title="ASSPCOTIA">
        </span>

        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <img src="<?= base_url('assets/imgs/logotipo_asspcotia_50x50.jpg') ?>" alt="Logo ASSPCOTIA" title="ASSPCOTIA">
        </span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><?=$this->session->userdata('user_st')?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <p>
                                <strong><?=$this->session->userdata('user')?><br></strong>
                                <strong>Perfil:</strong> <?=$this->session->userdata('perfil')?>
                                <small><strong>Data de Cadastro:</strong> <?=$this->session->userdata('dt_cad')?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?=base_url('./admin/usuario/ver/'.$this->session->userdata('id_user'))?>" class="btn btn-success btn-flat">Dados Cadastrais</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?=base_url('./admin/main/logoff')?>" class="btn btn-danger btn-flat">Sair</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MENU PRINCIPAL</li>
            <li>
                <a href="<?=base_url('./admin/main/dashboard')?>"><i class="fa fa-dashboard"></i> <span>Quadro Geral</span></a>
            </li>
            <li>
                <a href="<?=base_url('./admin/agenda/gerenciar')?>"><i class="fa fa-calendar" aria-hidden="true"></i> <span>Agenda</span></a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-plus" aria-hidden="true"></i> <span>Associados</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url('./admin/associado/requerimento') ?>"><i class="fa fa-circle-o"></i> Requerimentos</a></li>
                </ul>
            </li>
            <li>
                <a href="<?=base_url('./admin/banner/gerenciar')?>"><i class="fa fa-image" aria-hidden="true"></i> <span>Banners</span></a>
            </li>
            <li>
                <a href="<?=base_url('./admin/categoria/gerenciar')?>"><i class="fa fa-tags" aria-hidden="true"></i> <span>Categorias</span></a>
            </li>
            <li>
                <a href="<?=base_url('./admin/contato')?>"><i class="fa fa-comment" aria-hidden="true"></i> <span>Contatos</span></a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-building-o" aria-hidden="true"></i> <span>Estrutura</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url('./admin/estrutura/presidencia') ?>"><i class="fa fa-circle-o"></i> Presid&ecirc;ncia</a></li>
                    <li><a href="<?= base_url('./admin/estrutura/conselho') ?>"><i class="fa fa-circle-o"></i> Conselho Fiscal</a></li>
                    <li><a href="<?= base_url('./admin/estrutura/secretaria') ?>"><i class="fa fa-circle-o"></i> Secretaria</a></li>
                    <li><a href="<?= base_url('./admin/estrutura/socio') ?>"><i class="fa fa-circle-o"></i> S&oacute;cios</a></li>
                </ul>
            </li>
            <?php if ($this->session->userdata('id_perfil') == "2"): ?>
            <li>
                <a href="<?=base_url('./admin/usuario/editar/'.$this->session->userdata('id_user'))?>"><i class="fa fa-user" aria-hidden="true"></i> <span>Dados Cadastrais</span></a>
            </li>
            <?php endif; ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money" aria-hidden="true"></i> <span>Financeiro</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url('./admin/financeiro/despesa') ?>"><i class="fa fa-circle-o"></i> Despesas</a></li>
                    <li><a href="<?= base_url('./admin/financeiro/receita') ?>"><i class="fa fa-circle-o"></i> Receitas</a></li>
                </ul>
            </li>
            <li>
                <a href="<?=base_url('./admin/noticia/gerenciar')?>"><i class="fa fa-newspaper-o" aria-hidden="true"></i> <span>Not&iacute;cias</span></a>
            </li>
            <li>
                <a href="<?=base_url('./admin/parceria/gerenciar')?>"><i class="fa fa-users" aria-hidden="true"></i> <span>Parcerias</span></a>
            </li>
            <?php if ($this->session->userdata('id_perfil') == "1"): ?>
            <li>
                <a href="<?=base_url('./admin/usuario/gerenciar')?>"><i class="fa fa-user" aria-hidden="true"></i> <span>Usu&aacute;rios</span></a>
            </li>
            <?php endif; ?>
            <li>
                <a href="<?=base_url('./admin/main/logoff')?>"><i class="fa fa-sign-out"></i> <span>Sair</span></a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
