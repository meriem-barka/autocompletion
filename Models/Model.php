<?php
require_once './Core/Db.php';
class Model extends Db
{

    /**
     * Table de la base de données
     *
     * @var [type]
     */
    protected $table;


    /**
     * Instance de la classe Db
     *
     * @var [type]
     */
    private $db;



    /**
     * Methode pour recuperer le contenu d'une table.
     *Comment utilisé : notreModel->findAll()
     * @return $query->fetchAll() Retourne un fetchAll de la requete 
     */
    public function findAll(int $limit = null, int $offset = null, string $champ = null, string $ordre = null)
    {
        if (is_null($limit) && is_null($offset)) {

            return $this->requete("SELECT * FROM  $this->table ")->fetchAll();
        } else {

            return $this->requete("SELECT * FROM  $this->table ORDER BY $champ $ordre LIMIT $limit OFFSET $offset ")->fetchAll();
        }
    }



    /**
     * Méthode pour le nombre de ligne d'une tabla
     *
     */
    public function quantite()
    {
        return $this->requete("SELECT COUNT(*) as quantite FROM $this->table")->fetch();
    }




    /**
     * Methode pour recuperer le contenu d'une table par ordre de nom
     *Comment utilisé : notreModel->findAll()
     * @return $query->fetchAll() Retourne un fetchAll de la requete 
     */
    public function findAllByNameOrder($name)
    {
        return $this->requete('SELECT * FROM ' . $this->table . ' ORDER BY ' . $name)->fetchAll();
    }



    /**
     * Methode pour chercher dans la base de données avec des critères.
     * Comment utilisé : notreModel->findBY( [ ' Nom de la colonne ' => ' Valeur rechercher ' ] );
     * @param array $criteres Les critère de recherche dans la base de données
     * @return $this->requete() 
     */
    public function findBy(array $criteres)
    {
        $champs = [];
        $valeurs = [];

        //ON boucle pour eclater le tableau
        foreach ($criteres as $champ => $valeur) {

            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }

        //On transforme le tableau champs en une chaine de carractères
        $liste_champs = implode(' AND ', $champs);

        //ON exécute la requète
        return $this->requete('SELECT * FROM ' . $this->table . ' WHERE ' . $liste_champs, $valeurs)->fetchAll();
    }




    /**
     * Methode de recherche d'un element à partir de son id.
     * Comment utilisé : notreModel->find( Numéro de l'id );
     * @param integer $id L'id de recherche
     * @return $this->requete();
     */
    public function find(int $id)
    {
        return  $this->requete("SELECT * FROM {$this->table} WHERE id = ?", [$id])->fetch();
    }







    /**
     * Methode pour créer un nouveau elément.
     * Comment utilisé : notreModel->create( Le model hydrater );
     * @return $this->requete();
     */
    public function create()
    {
        $champs = [];
        $inter = [];
        $valeurs = [];

        //ON boucle pour eclater le tableau
        foreach ($this as $champ => $valeur) {

            if ($valeur !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }
        //On transforme le tableau champs en une chaine de carractères
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);

        //ON exécute la requète
        //les 2 return fonctionnent exactement pareil
        return $this->requete('INSERT INTO ' . $this->table . ' (' . $liste_champs . ') VALUES (' . $liste_inter . ')', $valeurs);
    }




    /**
     * Methode pour mettre a jour (update) un elément.
     * Comment utilisé : notreModel -> update( L'id de l'élément , Le model hydrater );
     * @return $this->requete();
     */
    public function update()
    {
        $champs = [];
        $valeurs = [];

        //ON boucle pour eclater le tableau
        foreach ($this as $champ => $valeur) {

            if ($valeur !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $this->id;

        //On transforme le tableau champs en une chaine de carractères
        $liste_champs = implode(', ', $champs);

        //ON exécute la requète
        return $this->requete('UPDATE ' . $this->table . ' SET ' . $liste_champs . ' WHERE id = ?', $valeurs);
    }




    /**
     * Méthode d'update sur un champ por mettre a jour une donnée
     * 
     * $champ le champ a mettre a jour
     * 
     * $valeur_champ la nouvelle valeur du champ
     * 
     * $champ_condition le champ de la condition après le where 
     * 
     * $valeur_champ_condition la valeur que doit avoir le champ de la condition where
     */
    public function updateByCol($champ, $valeur_champ, $champ_condition, $valeur_champ_condition)
    {

        //ON exécute la requète
        return $this->requete("UPDATE  $this->table  SET  $champ  = ?  WHERE  $champ_condition = ? ", [$valeur_champ, $valeur_champ_condition]);
    }






    /**
     * Methode pour suprimer (delete) un élément.
     * Comment utilisé : notreModel -> delete( l'id de l'élément a suprimer );
     * @param integer $id l'id de l'élément
     * @return $this->requete
     */
    public function delete(int $id)
    {
        return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }


    /**
     * Methode pour suprimer dans la base de données avec des critères.
     * Comment utilisé : notreModel->deleteBY( [ ' Nom de la colonne ' => ' Valeur rechercher ' ] );
     * @param array $criteres Les critère de recherche dans la base de données
     * @return $this->requete() 
     */
    public function deleteBy(array $criteres)
    {
        $champs = [];
        $valeurs = [];

        //ON boucle pour eclater le tableau
        foreach ($criteres as $champ => $valeur) {

            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }

        //On transforme le tableau champs en une chaine de carractères
        $liste_champs = implode(' AND ', $champs);

        //ON exécute la requète
        return $this->requete('DELETE FROM ' . $this->table . ' WHERE ' . $liste_champs, $valeurs);
    }




  /**
   *  //Methode pour preparer et exécuter une requete
   *
   * @param string $sql LA REQUETE A EXECUTE
   * @param array|null $attributs UN TABLEAU DE VALEURS
   * @return $query 
   */
    public function requete(string $sql, array $attributs = null)
    {

        //On recupère l'instance de Db
        $this->db = Db::getInstance();

        //On verifie si on a des attributs
        if ($attributs !== null) {
            //Requete préparée
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            //Requete simple
            return $this->db->query($sql);
        }
    }



    /**
     * Methode pour hydrater un model.
     * Comment utilisé : notreModel -> hydrate( Le tableau de données );
     * @param array $donnees Un tableau de données pour hydrater un model
     * @return $this
     */
    public function hydrate($donnees)
    {
        foreach ($donnees as $key => $value) {

            //On récupère le setter correspondant a la clé (key) de chaque parametre dans le tableau des données
            $setter = 'set' . ucfirst($key);

            //On verifie si le setter existe
            if (method_exists($this, $setter)) {

                //On appelle le setter
                $this->$setter($value);
            }
        }
        return $this;
    }
}
