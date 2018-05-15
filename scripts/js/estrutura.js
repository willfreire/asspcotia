Estrutura = {

    /*!
     * @description Chamada dos principais métodos
     **/
    main: function () {

        // Botao voltar
        $('#btn_back').click(function(){
            Estrutura.redirect('../');
        });

        // Voltar Conselho
        $('#btn_back_conselho').click(function(){
            Estrutura.redirect('../conselho');
        });

        // Voltar Socio
        $('#btn_back_socio').click(function(){
            Estrutura.redirect('../socio');
        });

        // Botao cadastrar Conselho
        $('#btn_redirect_cad_cons').click(function(){
            var url = ""+protocol+"//"+hostname+"/"+pathproj+"/admin/estrutura/conselho_cadastrar";
            Estrutura.redirect(url);
        });

        // Botao cadastrar Socio
        $('#btn_redirect_cad_soc').click(function(){
            var url = ""+protocol+"//"+hostname+"/"+pathproj+"/admin/estrutura/socio_cadastrar";
            Estrutura.redirect(url);
        });

        // Presidencia Editar
        $('#frm_edit_presidencia').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                presidente: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio o preenchimento do campo <strong>PRESIDENTE</strong>'
                        },
                        stringLength: {
                            min: 5,
                            max: 150,
                            message: 'O campo <strong>PRESIDENTE</strong> deve ter entre <strong>5</strong> e <strong>150</strong> caracteres'
                        }
                    }
                },
                vice: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio o preenchimento do campo <strong>VICE-PRESIDENTE</strong>'
                        },
                        stringLength: {
                            min: 5,
                            max: 150,
                            message: 'O campo <strong>VICE-PRESIDENTE</strong> deve ter entre <strong>5</strong> e <strong>150</strong> caracteres'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            var frm = $form.serialize();
            var url = "./updatePresidencia";

            // Use Ajax to submit form data
            $.post(url, frm, function (data) {
                if (data.status === true) {
                    Estrutura.modalMsg("MENSAGEM", data.msg, false, '../');
                } else {
                    Estrutura.modalMsg("Aten&ccedil;&atilde;o", data.msg);
                }
                $('#btn_edit_presidencia').removeAttr('disabled');
            }, 'json');

        });

        // Secretaria Editar
        $('#frm_edit_secretaria').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                st_secretario: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio o preenchimento do campo <strong>1º SECRETARIO</strong>'
                        },
                        stringLength: {
                            min: 5,
                            max: 150,
                            message: 'O campo <strong>1º SECRETARIO</strong> deve ter entre <strong>5</strong> e <strong>150</strong> caracteres'
                        }
                    }
                },
                rd_secretario: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio o preenchimento do campo <strong>2º SECRETARIO</strong>'
                        },
                        stringLength: {
                            min: 5,
                            max: 150,
                            message: 'O campo <strong>2º SECRETARIO</strong> deve ter entre <strong>5</strong> e <strong>150</strong> caracteres'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            var frm = $form.serialize();
            var url = "./updateSecretaria";

            // Use Ajax to submit form data
            $.post(url, frm, function (data) {
                if (data.status === true) {
                    Estrutura.modalMsg("MENSAGEM", data.msg, false, '../');
                } else {
                    Estrutura.modalMsg("Aten&ccedil;&atilde;o", data.msg);
                }
                $('#btn_edit_secretaria').removeAttr('disabled');
            }, 'json');

        });

        // Conselho Cadastrar
        $('#frm_cad_conselho').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                conselheiro: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio o preenchimento do campo <strong>CONSELHEIRO</strong>'
                        },
                        stringLength: {
                            min: 5,
                            max: 150,
                            message: 'O campo <strong>CONSELHEIRO</strong> deve ter entre <strong>5</strong> e <strong>150</strong> caracteres'
                        }
                    }
                },
                suplente: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio a sele&ccedil;&atilde;o do campo <strong>SUPLENTE</strong>'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            var frm = $form.serialize();
            var url = "./createConselho";

            // Use Ajax to submit form data
            $.post(url, frm, function (data) {
                if (data.status === true) {
                    Estrutura.modalMsg("MENSAGEM", data.msg, false, './conselho');
                } else {
                    Estrutura.modalMsg("Aten&ccedil;&atilde;o", data.msg);
                }
                $('#btn_cad_conselho').removeAttr('disabled');
            }, 'json');

        });

        // Conselho Editar
        $('#frm_edit_conselho').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                conselheiro: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio o preenchimento do campo <strong>CONSELHEIRO</strong>'
                        },
                        stringLength: {
                            min: 5,
                            max: 150,
                            message: 'O campo <strong>CONSELHEIRO</strong> deve ter entre <strong>5</strong> e <strong>150</strong> caracteres'
                        }
                    }
                },
                suplente: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio a sele&ccedil;&atilde;o do campo <strong>SUPLENTE</strong>'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            var frm = $form.serialize();
            var url = "../updateConselho";

            // Use Ajax to submit form data
            $.post(url, frm, function (data) {
                if (data.status === true) {
                    Estrutura.modalMsg("MENSAGEM", data.msg, false, '../conselho');
                } else {
                    Estrutura.modalMsg("Aten&ccedil;&atilde;o", data.msg);
                }
                $('#btn_edit_conselho').removeAttr('disabled');
            }, 'json');

        });

        // Socio Cadastrar
        $('#frm_cad_socio').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                socio: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio o preenchimento do campo <strong>S&Oacute;CIO</strong>'
                        },
                        stringLength: {
                            min: 5,
                            max: 150,
                            message: 'O campo <strong>S&Oacute;CIO</strong> deve ter entre <strong>5</strong> e <strong>150</strong> caracteres'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            var frm = $form.serialize();
            var url = "./createSocio";

            // Use Ajax to submit form data
            $.post(url, frm, function (data) {
                if (data.status === true) {
                    Estrutura.modalMsg("MENSAGEM", data.msg, false, './socio');
                } else {
                    Estrutura.modalMsg("Aten&ccedil;&atilde;o", data.msg);
                }
                $('#btn_cad_socio').removeAttr('disabled');
            }, 'json');

        });

        // Conselho Editar
        $('#frm_edit_socio').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                socio: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio o preenchimento do campo <strong>S&Oacute;CIO</strong>'
                        },
                        stringLength: {
                            min: 5,
                            max: 150,
                            message: 'O campo <strong>S&Oacute;CIO</strong> deve ter entre <strong>5</strong> e <strong>150</strong> caracteres'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            var frm = $form.serialize();
            var url = "../updateSocio";

            // Use Ajax to submit form data
            $.post(url, frm, function (data) {
                if (data.status === true) {
                    Estrutura.modalMsg("MENSAGEM", data.msg, false, '../socio');
                } else {
                    Estrutura.modalMsg("Aten&ccedil;&atilde;o", data.msg);
                }
                $('#btn_edit_socio').removeAttr('disabled');
            }, 'json');

        });
    },

    /*!
     * @description Método para abrir modal de mensagem
     **/
    modalMsg: function (title, msg, focus, redirect) {

	$("#title_modal").html(title);
	$("#mensagem_modal").html(msg);
	$("#msg_modal").modal('show');

	if (focus) {
	    $("#msg_modal").on('hidden.bs.modal', function (e) {
		Estrutura.setFocus(focus);
		e.preventDefault();
	    });
	}

	if (redirect) {
	    $("#msg_modal").on('hidden.bs.modal', function (e) {
		Estrutura.redirect(redirect);
		e.preventDefault();
	    });
	}

    },

    /*!
     * @description Método para exclusao de um registro do Conselho Fiscal
     **/
    delConselho: function(id) {
        bootbox.dialog({
            message: "<i class='fa fa-exclamation-triangle'></i> Deseja realmente <strong>Excluir</strong> esse Conselheiro?",
            title: "ATEN&Ccedil;&Atilde;O",
            buttons: {
                success: {
                    label: "Cancelar",
                    className: "btn-primary"
                },
                danger: {
                    label: "Excluir",
                    className: "btn-danger",
                    callback: function() {
                        // Excluir registro
                        $.post('./deleteConselho', {
                            id: id
                        },function(data){
                            if (data.status === true) {
                                Estrutura.modalMsg("MENSAGEM", data.msg, false, false);
                                // Reload grid
                                $('#tbl_estrutura').DataTable().ajax.reload();
                            } else {
                                Estrutura.modalMsg("ATEN&Ccedil;&Atilde;O", data.msg, false, false);
                            }
                        }, 'json');
                    }
                }
            }
        });
    },

    /*!
     * @description Método para exclusao de um registro do Socio
     **/
    delSocio: function(id) {
        bootbox.dialog({
            message: "<i class='fa fa-exclamation-triangle'></i> Deseja realmente <strong>Excluir</strong> esse Sócio?",
            title: "ATEN&Ccedil;&Atilde;O",
            buttons: {
                success: {
                    label: "Cancelar",
                    className: "btn-primary"
                },
                danger: {
                    label: "Excluir",
                    className: "btn-danger",
                    callback: function() {
                        // Excluir registro
                        $.post('./deleteSocio', {
                            id: id
                        },function(data){
                            if (data.status === true) {
                                Estrutura.modalMsg("MENSAGEM", data.msg, false, false);
                                // Reload grid
                                $('#tbl_estrutura').DataTable().ajax.reload();
                            } else {
                                Estrutura.modalMsg("ATEN&Ccedil;&Atilde;O", data.msg, false, false);
                            }
                        }, 'json');
                    }
                }
            }
        });
    },

    /*!
     * @description Método colocar focus em um campo
     **/
    setFocus: function (id_field) {
	$("#" + id_field).focus();
    },

    /*!
     * @description Método redirecionamento de link
     **/
    redirect: function (link) {
        window.location.href = link;
    },

    /*!
     * @description Método abrir janela
     **/
    openWindow: function (link, target) {
	window.open(link, target);
    },

    /*!
     * @description Metodo para permitir o input de apenas numeros
     **/
    onlyNumber: function (nameField) {
	$("input[name=" + nameField + "]").keydown(function (e) {
	    if (e.shiftKey)
		e.preventDefault();
	    if (!((e.keyCode == 46) || (e.keyCode == 8) || (e.keyCode == 9) // DEL, Backspace e Tab
                    || (e.keyCode == 17) || (e.keyCode == 91) || (e.keyCode == 86) || (e.keyCode == 67) // Ctrl+C / Ctrl+V
		    || ((e.keyCode >= 35) && (e.keyCode <= 40)) // HOME, END, Setas
		    || ((e.keyCode >= 96) && (e.keyCode <= 105)) // Númerod Pad
		    || ((e.keyCode >= 48) && (e.keyCode <= 57))))
		e.preventDefault(); // Números
	});
    }

};

$(document).ready(function () {
    Estrutura.main();
});
