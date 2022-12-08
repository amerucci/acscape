<?php $title = "Administration des jeux"; ?>
<?php $scripts = $params['scripts']; ?>
<div class="container admin_container d-flex justify-content-center align-items-center flex-column gap-5">
    <h1>Administration des Jeux</h1>

    <?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">Vous êtes connecté!</div>
    <script>
        setTimeout(function () {
            document.querySelector('.alert').style.display = 'none';
        }, 2000);
    </script>
    <?php endif ?>

    <div class="accordion w-50" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Créer votre propre escape game.
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body d-flex justify-content-center flex-column">
                    <p class="">Comment ça marche ?</p>
                    <p class="m-0">&#x2022; Vous pouvez créer votre propre escape game en quelques clics</p>
                    <p class="m-0">&#x2022; Pour celà, vous devrez d'abord créer un scénario</p>
                    <p class="m-0">&#x2022; Une fois votre scénario créé vous aurez accès à sa composition</p>
                    <p class="m-0">&#x2022; Vous pourrez alors ajouter des indices, des énigmes et des réponses aux
                        meubles et
                        pièces</p>
                    <p class="m-0">&#x2022; Le but du jeu sera de franchir toute les pièces, et une fois arrivé.e à la
                        dernière pièce la partie sera gagnée, et affichera votre message de victoire.</p>

                </div>
            </div>
        </div>
    </div>


    <div class="d-flex gap-5">
        <div class="d-flex align-items-center script_create_home">
            <a class="mx-2" href="script/create">
                Créer un scénario
            </a>
        </div>
        <?php foreach (array_slice($scripts, 0, 1) as $script) : ?>
        <?php if ($script->user_id == $_SESSION['user_id']): ?>
        <div class="d-flex align-items-center game_admnistration">
            <a class="mx-2 text-center" href="script">
                Gérer vos jeux
            </a>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>