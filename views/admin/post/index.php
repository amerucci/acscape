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
    <h6>Gérer vos scénario :</h6>
    <a class="mx-2" href="script">ici</a>
</div>

<div class="d-flex">
    <h6>Gérer vos salles :</h6>
    <a class="mx-2" href="room">ici</a>
</div>

<div class="d-flex">
    <h6>Gérer vos meubles :</h6>
    <a class="mx-2" href="furniture">ici</a>
</div>

<div class="d-flex">
    <h6>Gérer vos objets :</h6>
    <a class="mx-2" href="objects">ici</a>
</div>