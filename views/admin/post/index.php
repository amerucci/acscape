<?php $title = "Administration des jeux"; ?>
<h1>Administration des Jeux</h1>

<?php if(isset($_GET['success'])): ?>
<div class="alert alert-success">Vous êtes connecté!</div>
<script>
    setTimeout(function () {
        document.querySelector('.alert').style.display = 'none';
    }, 2000);
</script>
<?php endif ?>

<div class="d-flex">
    <h6>Gérer vos jeux :</h6>
    <a class="mx-2" href="script">ici</a>
</div>

<!-- créer un scénario -->
<div class="d-flex">
    <h6>Créer un scénario :</h6>
    <a class="mx-2" href="script/create">ici</a>
</div>

<?php unset($_SESSION['script_id']); ?>