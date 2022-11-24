<h1>Administration des Jeux</h1>

<?php if(isset($_GET['success'])): ?>
<div class="alert alert-success">Vous êtes connecté!</div>
<script>
    setTimeout(function () {
        document.querySelector('.alert').style.display = 'none';
    }, 2000);
</script>
<?php endif ?>