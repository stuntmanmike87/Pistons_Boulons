<div class="col">
    <h1>Formulaire de contact</h1>
    <form class="" method="POST" action="" role="form">
        <div class="col-md-12 col-sm-12 col-6">
            <div class="form-group">
                <label for="form_name">Nom : *
                </label>
                <input id="form_name" type="text" name="name" class="form-control" id="nom" placeholder="Veuillez entrer votre Nom" required data-error="Votre nom est obligatoire." pattern="^[A-Za-z\-]+$">
            </div>
            <div class="form-group">
                <label for="form_lastname">Prénom : *</label>
                <input id="form_lastname" type="text" name="surname" class="form-control" id="prenom" placeholder="Veuillez entrer votre Prénom" required data-error="Votre prénom est obligatoire." pattern="^[A-Za-z\-]+$">
            </div>
            <div class="form-group">
                <label for="form_email">Email : *</label>
                <input id="form_email" type="email" name="email" class="form-control" id="email" placeholder="Veuillez entrer votre Email" required data-error="Une adresse email valide est obligatoire.">
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label for="form_message">Message : *</label>
                <textarea id="form_message" name="message" class="form-control" placeholder="Veuillez entrer votre Message" rows="4" required data-error="Veuillez remplir le champ Message."></textarea>
            </div>
            <p class="text-muted">
                <strong>*</strong> Ces champs sont obligatoires.
            </p>

            <a href="#" type="submit" class="button float-right"  data-toggle="modal" data-target="#myModal">Nous contacter</a>
        </div>
    </form>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Message</h4>
            </div>
            <div class="modal-body">
                <p>Votre message a bien été envoyé.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>

    </div>
</div>