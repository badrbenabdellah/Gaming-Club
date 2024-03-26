    // -------   Mail Send ajax

    $(document).ready(function() {
        const form = $('#contactForm'); // formulaire de contact
        const submit = $('.submit-btn'); // bouton de soumission
        const alert = $('.alert-msg'); // div d'alerte pour afficher les messages d'alerte

        // événement de soumission du formulaire
        form.on('submit', function(e) {
            e.preventDefault(); // empêcher la soumission par défaut du formulaire

            $.ajax({
                url: '../contact_process.php', // URL d'action du formulaire
                type: 'POST', // méthode de soumission du formulaire : get/post
                dataType: 'html', // type de requête : html/json/xml
                data: form.serialize(), // sérialiser les données du formulaire
                beforeSend: function() {
                    alert.fadeOut();
                    submit.html('Envoi en cours....'); // changer le texte du bouton de soumission
                },
                success: function(data) {
                    alert.html(data).fadeIn(); // faire apparaître les données de la réponse
                    form.trigger('reset'); // réinitialiser le formulaire
                    submit.attr("style", "display: none !important"); // réinitialiser le texte du bouton de soumission
                },
                error: function(e) {
                    console.log(e)
                }
            });
        });
    });
