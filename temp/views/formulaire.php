<form method="post" action="test">
    <p>Donnee : <?php print_r($response->getAttribute('etudiant')) ?></p>
    <label for="n">
        <p>Nom</p>
        <input id="n" type="text" name="nom">
    </label>
    <input type="submit" value="Envoyer">
</form>