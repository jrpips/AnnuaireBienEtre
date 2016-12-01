var GpAnnuaire_Call_Ajax = GpAnnuaire_Call_Ajax || {
        /**
         *  call by ajaxCommentaire
         */
        'successAjaxCommentaire': function (data) {

            if (!data.valide) {

                $('.errorCommentaire').remove();
                GpAnnuaire.resetForm('section');
                for (item in data.errors) {
                    $('#commentaire_' + item).parent().append('<div class="errorCommentaire" >' + data.errors[item][0] + '</div>');
                }
            } else {

            }
        },
        /**
         *  call by ajaxPreSignup
         */
        'successAjaxPreSignup': function (data) {

            if (data.valide) {

                $('.error').remove();
                $('[type=submit]')//ajout de la balise contenant le message de validation
                    .parent()
                    .parent()
                    .append('<div class="message"><i class="glyphicon glyphicon-send"></i> Un email de confirmation a été envoyé l\'adresse <br><span>' + data.values.sign_up.email + '</span></div>')
                ;
                $('#body div.message').css({'display': 'block'}).slideDown('slow');
                setTimeout(function () {//aprés 5s

                    $('#body div.message').remove();

                    GpAnnuaire.resetForm('#body');//reset du formulaire
                    GpAnnuaire.hide();//retrait de la popup

                }, 5000);
            }
            else {
                $('.error').remove();

                for (item in data.errors) {
                    $('#sign_up_' + item).parent().append('<div class="error">' + data.errors[item][0] + '</div>');
                }
            }
        },
        /**
         * call by ajaxAutocompleteAdresse
         */
        'beforeSendAjaxAutocompleteAdresse': function () {

            if ($('.loader').length === 0) {
                $('#' + event_id).parent().append('<div class="loader"><img src="http://127.0.0.1/Annuaire-Bien-Etre/web/image/Loading_icon.gif"/></div>');
            }
            $('#' + event_id + ' option').remove();
        },
        'successAjaxAutocompleteAdresse': function (data) {

            $('.loader').remove();

            var prefix = event_id;
            var event_id_length = event_id.length - 10;
            event_id = prefix.substring(0, event_id_length);

            $('#' + event_id + 'commune option').remove();
            $.each(data.communes, function (index, value) {
                $('#' + event_id + 'commune').append($('<option>', {value: value, text: value}));
            });
            $('#' + event_id + 'localite').val(data.province);

        },
        /**
         *  call by ajaxContactPrestataire
         */
        'successAjaxContactPrestataire': function (data) {

            if (data.valide) {
                $('.errorCommentaire').remove();
                GpAnnuaire.resetForm('#contactPresta');
                $('#info').empty().text('Votre message est envoyé!');
                var back = function () {
                    $('#info').empty().html("Champs obligatoires <span class='required' >*</span>");
                };
                setTimeout(back, 5000);
            } else {
                $('.errorCommentaire').remove();
                for (item in data.errors) {
                    $('#contact_prestataire_' + item).parent().append('<div class="errorCommentaire" >' + data.errors[item][0] + '</div>');
                }
            }
        }
    }
