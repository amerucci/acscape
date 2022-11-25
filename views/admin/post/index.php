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

<h6>Gérer vos scénario :</h6>
<a href="script">ici</a>

<h6>Gérer vos salles :</h6>
<a href="room">ici</a>