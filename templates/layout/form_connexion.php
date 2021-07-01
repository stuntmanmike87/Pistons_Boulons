<div class="container mt-3 mb-5">
    <div class="row">
        <div class="col-lg-3"></div>

        <div class="col-lg-6 col-md-12">
            <form class="" action='' method="POST">
                <fieldset>
                    <div class="col text-center">
                        <h2>Connexion</h2>
                    </div>

                    <div class="">
                        <!-- Identifiant -->
                        <label class="" for="username">Identifiant</label>
                        <div class="">
                            <input type="text" id="username" name="username" placeholder="Entrer votre identifiant" class="">
                        </div>
                    </div>
                    <div class="mt-2">
                        <!-- mot de passe -->
                        <label class="" for="password">Mot de passe :</label>
                        <div class="d-flex">
                            <input type="password" value="" placeholder="Entrer votre mot de passe" id="password">
                            <div class="affichage_mdp" title="Voir mot de passe">
                                <i class="fa fa-eye text-center icone_oeil"></i>
                                <span class="lib_icone_oeil text-center">VOIR</span>
                            </div>
                        </div>
                    </div>
                    <div class=" mt-5">
                        <div class="bonton_contact col text-center">
                            <input type="button" href="" value="Connexion" class="">
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="col-lg- 3"></div>
        
    </div>
</div>

<script>
    $(document).ready(function() {

        $('.affichage_mdp').click(function() {
            if ($(this).prev('input').prop('type') == 'password') {
                //Si c'est un input de type password
                $(this).prev('input').prop('type', 'text');
            } else {
                //Sinon
                $(this).prev('input').prop('type', 'password');

            }
        });

    });
</script>