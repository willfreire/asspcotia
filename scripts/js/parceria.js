Parceria = {

    /*!
     * @description Chamada dos principais métodos
     **/
    main: function () {

        // Botao voltar
        $('#btn_back').click(function(){
            Parceria.redirect('../gerenciar');
        });

        // Botao cadastrar
        $('#btn_redirect_cad').click(function(){
            var url = ""+protocol+"//"+hostname+"/"+pathproj+"/admin/parceria/cadastrar";
            Parceria.redirect(url);
        });

        // Parceria Cadastrar
        $('#frm_cad_parceria').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                categoria: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio a sele&ccedil;&atilde;o do campo <strong>CATEGORIA</strong>'
                        }
                    }
                },
                nome: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio o preenchimento do campo <strong>NOME</strong>'
                        },
                        stringLength: {
                            min: 5,
                            max: 200,
                            message: 'O campo <strong>NOME</strong> deve ter entre <strong>5</strong> e <strong>200</strong> caracteres'
                        }
                    }
                },
                img: {
		    validators: {
			notEmpty: {
			    message: '&Eacute; obrigat&oacute;rio selecionar uma <strong>IMAGEM</strong>'
			},
                        file: {
                            maxSize : 50 * 1024 * 1024,
                            message : 'A IMAGEM deve ser no formato <strong>.jpg, .jpeg ou .png</strong> e n&atilde;o deve exceder <strong>50MB</strong> em tamanho!'
                        }
		    }
		},
                descricao: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio o preenchimento do campo <strong>DESCRI&Ccedil;&Atilde;O</strong>'
                        }
                    }
                },
                status: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio a sele&ccedil;&atilde;o do campo <strong>STATUS</strong>'
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
            var url = "./create";

            // Use Ajax to submit form data
            $.ajax({
                url         : url,
                type        : 'POST',
                dataType    : 'json',
                data        : new FormData($($form)[0]),
                cache       : false,
                contentType : false,
                processData : false,
                success     : function(data) {
                    if (data.status === true) {
                        Parceria.modalMsg("MENSAGEM", data.msg, false, './gerenciar');
                    } else {
                        Parceria.modalMsg("Aten&ccedil;&atilde;o", data.msg);
                    }
                    $('#btn_cad_parceria').removeAttr('disabled');
                }
            });

        });

        // Parceria Editar
        $('#frm_edit_parceria').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                categoria: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio a sele&ccedil;&atilde;o do campo <strong>CATEGORIA</strong>'
                        }
                    }
                },
                nome: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio o preenchimento do campo <strong>NOME</strong>'
                        },
                        stringLength: {
                            min: 5,
                            max: 200,
                            message: 'O campo <strong>NOME</strong> deve ter entre <strong>5</strong> e <strong>200</strong> caracteres'
                        }
                    }
                },
                img: {
		    validators: {
                        file: {
                            maxSize : 50 * 1024 * 1024,
                            message : 'A IMAGEM deve ser no formato <strong>.jpg, .jpeg ou .png</strong> e n&atilde;o deve exceder <strong>50MB</strong> em tamanho!'
                        },
			callback: {
			    callback: function (value, validator, $field) {
				var img_nome = $('#img_anexo').val();
				if (img_nome === "" && value === "") {
				    return {
					valid: false,
					message: '&Eacute; obrigat&oacute;rio selecionar uma <strong>IMAGEM</strong>'
				    };
				}
				return true;
			    }
			}
		    }
		},
                descricao: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio o preenchimento do campo <strong>DESCRI&Ccedil;&Atilde;O</strong>'
                        }
                    }
                },
                status: {
                    validators: {
                        notEmpty: {
                            message: '&Eacute; obrigat&oacute;rio a sele&ccedil;&atilde;o do campo <strong>STATUS</strong>'
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
            var url = "../update";

            // Use Ajax to submit form data
            $.ajax({
                url         : url,
                type        : 'POST',
                dataType    : 'json',
                data        : new FormData($($form)[0]),
                cache       : false,
                contentType : false,
                processData : false,
                success     : function(data) {
                    if (data.status === true) {
                        Parceria.modalMsg("MENSAGEM", data.msg, false, '../gerenciar');
                    } else {
                        Parceria.modalMsg("Aten&ccedil;&atilde;o", data.msg);
                    }
                    $('#btn_edit_parceria').removeAttr('disabled');
                }
            });
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
		Parceria.setFocus(focus);
		e.preventDefault();
	    });
	}

	if (redirect) {
	    $("#msg_modal").on('hidden.bs.modal', function (e) {
		Parceria.redirect(redirect);
		e.preventDefault();
	    });
	}

    },

    /*!
     * @description Método para exclusao de um registro
     **/
    del: function(id) {
        bootbox.dialog({
            message: "<i class='fa fa-exclamation-triangle'></i> Deseja realmente <strong>Excluir</strong> essa Parceria?",
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
                        $.post('./delete', {
                            id: id
                        },function(data){
                            if (data.status === true) {
                                Parceria.modalMsg("MENSAGEM", data.msg, false, false);
                                // Reload grid
                                $('#tbl_parceria').DataTable().ajax.reload();
                            } else {
                                Parceria.modalMsg("ATEN&Ccedil;&Atilde;O", data.msg, false, false);
                            }
                        }, 'json');
                    }
                }
            }
        });
    },

    /*!
     * @description Método de envio de arquivo do editor
     **/
    sendFile: function(file) {
        data = new FormData();
        data.append("file", file);
        $.ajax({
            data        : data,
            type        : 'POST',
            dataType    : 'json',
            url         : ""+protocol+"//"+hostname+"/"+pathproj+"/admin/parceria/saveFile",
            cache       : false,
            contentType : false,
            processData : false,
            success     : function(dados) {
                $('#parceria').summernote('insertImage', dados.url, dados.img);
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
    Parceria.main();
});
