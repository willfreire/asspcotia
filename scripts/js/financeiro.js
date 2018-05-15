Financeiro = {

    /*!
     * @description Chamada dos principais métodos
     **/
    main: function () {

        // Botao voltar Despesa
        $('#btn_back_despesa').click(function(){
            Financeiro.redirect('../despesa');
        });

        // Botao voltar Receita
        $('#btn_back_receita').click(function(){
            Financeiro.redirect('../receita');
        });

        // Botao cadastrar Despesa
        $('#btn_redirect_cad_des').click(function(){
            var url = ""+protocol+"//"+hostname+"/"+pathproj+"/admin/financeiro/despesa_cadastrar";
            Financeiro.redirect(url);
        });

        // Botao cadastrar Receita
        $('#btn_redirect_cad_rec').click(function(){
            var url = ""+protocol+"//"+hostname+"/"+pathproj+"/admin/financeiro/receita_cadastrar";
            Financeiro.redirect(url);
        });

        // Mascara
        Financeiro.onlyNumber('ano');
        $("#vl_fixado").maskMoney({
            thousands     : '.',
            decimal       : ',',
            allowNegative : true
        });
        $("#vl_gasto").maskMoney({
            thousands     : '.',
            decimal       : ',',
            allowNegative : true
        });
        $("#vl_previsto").maskMoney({
            thousands     : '.',
            decimal       : ',',
            allowNegative : true
        });
        $("#vl_arrecadado").maskMoney({
            thousands     : '.',
            decimal       : ',',
            allowNegative : true
        });

        // Despesa Cadastrar
        $('#frm_cad_despesa').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                ano: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio o preenchimento do campo <strong>ANO</strong>'
                        },
                        stringLength: {
                            min: 4,
                            max: 4,
                            message: 'Digite um <strong>ANO</strong> válido!'
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
            var url = "./createDespesa";

            // Use Ajax to submit form data
            $.post(url, frm, function (data) {
                if (data.status === true) {
                    Financeiro.modalMsg("MENSAGEM", data.msg, false, './despesa');
                } else {
                    Financeiro.modalMsg("Aten&ccedil;&atilde;o", data.msg);
                }

                $('#btn_cad_despesa').removeAttr('disabled');
            }, 'json');

        });

        // Despesa Editar
        $('#frm_edit_despesa').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                ano: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio o preenchimento do campo <strong>ANO</strong>'
                        },
                        stringLength: {
                            min: 4,
                            max: 4,
                            message: 'Digite um <strong>ANO</strong> válido!'
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
            var url = "../updateDespesa";

            // Use Ajax to submit form data
            $.post(url, frm, function (data) {
                if (data.status === true) {
                    Financeiro.modalMsg("MENSAGEM", data.msg, false, '../despesa');
                } else {
                    Financeiro.modalMsg("Aten&ccedil;&atilde;o", data.msg);
                }
                $('#btn_edit_despesa').removeAttr('disabled');
            }, 'json');
        });

        // Receita Cadastrar
        $('#frm_cad_receita').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                ano: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio o preenchimento do campo <strong>ANO</strong>'
                        },
                        stringLength: {
                            min: 4,
                            max: 4,
                            message: 'Digite um <strong>ANO</strong> válido!'
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
            var url = "./createReceita";

            // Use Ajax to submit form data
            $.post(url, frm, function (data) {
                if (data.status === true) {
                    Financeiro.modalMsg("MENSAGEM", data.msg, false, './receita');
                } else {
                    Financeiro.modalMsg("Aten&ccedil;&atilde;o", data.msg);
                }
                $('#btn_cad_receita').removeAttr('disabled');
            }, 'json');

        });

        // Receita Editar
        $('#frm_edit_receita').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                ano: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio o preenchimento do campo <strong>ANO</strong>'
                        },
                        stringLength: {
                            min: 4,
                            max: 4,
                            message: 'Digite um <strong>ANO</strong> válido!'
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
            var url = "../updateReceita";

            // Use Ajax to submit form data
            $.post(url, frm, function (data) {
                if (data.status === true) {
                    Financeiro.modalMsg("MENSAGEM", data.msg, false, '../receita');
                } else {
                    Financeiro.modalMsg("Aten&ccedil;&atilde;o", data.msg);
                }
                $('#btn_edit_receita').removeAttr('disabled');
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
		Financeiro.setFocus(focus);
		e.preventDefault();
	    });
	}

	if (redirect) {
	    $("#msg_modal").on('hidden.bs.modal', function (e) {
		Financeiro.redirect(redirect);
		e.preventDefault();
	    });
	}

    },

    /*!
     * @description Método para exclusao de um registro de Despesa
     **/
    delDespesa: function(id) {
        bootbox.dialog({
            message: "<i class='fa fa-exclamation-triangle'></i> Deseja realmente <strong>Excluir</strong> essa Despesa?",
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
                        $.post('./deleteDespesa', {
                            id: id
                        },function(data){
                            if (data.status === true) {
                                Financeiro.modalMsg("MENSAGEM", data.msg, false, false);
                                // Reload grid
                                $('#tbl_financeiro').DataTable().ajax.reload();
                            } else {
                                Financeiro.modalMsg("ATEN&Ccedil;&Atilde;O", data.msg, false, false);
                            }
                        }, 'json');
                    }
                }
            }
        });
    },

    /*!
     * @description Método para exclusao de um registro de Receita
     **/
    delReceita: function(id) {
        bootbox.dialog({
            message: "<i class='fa fa-exclamation-triangle'></i> Deseja realmente <strong>Excluir</strong> essa Receita?",
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
                        $.post('./deleteReceita', {
                            id: id
                        },function(data){
                            if (data.status === true) {
                                Financeiro.modalMsg("MENSAGEM", data.msg, false, false);
                                // Reload grid
                                $('#tbl_financeiro').DataTable().ajax.reload();
                            } else {
                                Financeiro.modalMsg("ATEN&Ccedil;&Atilde;O", data.msg, false, false);
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
    Financeiro.main();
});
