<form action="create" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Nom du scénario</label>
        <input type="text" class="form-control" name="title" id="title" required>
    </div>
    <div class="form-group">
        <label for="difficulty">Difficulté</label>
        <select class="form-control" name="difficulty" id="difficulty">
            <option value="1">Très Facile</option>
            <option value="2">Facile</option>
            <option value="3">Moyen</option>
            <option value="4">Difficile</option>
            <option value="5">Très Difficile</option>
        </select>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="content">Message de victoire</label>
            <textarea class="form-control" name="winner_msg" id="content" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="content">Message de défaite</label>
            <textarea class="form-control" name="lost_msg" id="content" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="picture">Image</label>
            <input type="file" class="form-control-file" name="picture" id="picture">
        </div>
        <div class="form-group">
            <label for="duration">Durée</label>
            <input type="time" class="form-control" name="duration" id="duration" min="00:10" max="01:00" value="01:00">
        </div>
        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
        <button type="submit" class="btn btn-primary">Créer</button>
</form>