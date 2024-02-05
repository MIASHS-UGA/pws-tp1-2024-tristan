<article>
<h2>Ajout d'un article</h2>

<p>Les données du formulaire seront envoyées vers le serveur en méthode HTTP "post" et seront disponibles côté serveur dans la variable PHP $_POST</p>

<form action="" method="post">
  <label for="article_title">Titre : </label>
  <input type="text" name="article_title">
  <label for="article_content">Contenu : </label>
  <textarea name="article_content"></textarea>
  <input type="submit" value="Ajouter" name="ajout_article">
</form>
</article>

<?php
class Article
{
protected $pdo;
function __construct()
{
try {
$this->pdo = new \PDO('sqlite:' . DB_PATH);
} catch (Exception $e) {
print "Erreur de connexion à la base de données : " . $e->getMessage() .
"<br/>";
die();
}
}
function list()
{
try {
$query = $this->pdo->prepare('SELECT * FROM articles');
$query->execute();
return $query->fetchAll(PDO::FETCH_CLASS);
} catch (Exception $e) {
print "Erreur fonction list() dans le modèle Article : " .
$e->getMessage() . "<br/>";
die();
}
}
function add($data)
{
try {
if (isset($data['article_title']) && isset($data['article_content'])) {
$query = $this->pdo->prepare('INSERT INTO articles ("article_title",
"article_content") VALUES (?,?)');
$query->execute([$data['article_title'], $data['article_content']]);
return true;
}
return false;
} catch (Exception $e) {
print "Erreur fonction add($data) dans le modèle Article : " .
$e->getMessage() . "<br/>";
die();
}
}
}