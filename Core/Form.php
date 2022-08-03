<?php

namespace App\Core;

class Form
{

    private $formCode = "";

    /**
     * Génère un formulaire html
     *
     * @return string
     */
    public function create()
    {
        return $this->formCode;
    }



    /**
     * Verifie la validité des champs
     *
     * @param array $form Tableau issue du formulaire($_POST, $_GET)
     * @param array $champs Tableau listant les champs obligatoires
     * @return bool
     */
    public static function validate(array $form, array $champs)
    {
        // On parcourt les champs
        foreach ($champs as $champ) {
            //si le champ est absent ou vide dans le formulaire
            if (!isset($form[$champ]) || empty($form[$champ])) {
                // On sort en retournant false
                return false;
            }
        }
        return true;
    }


    /**
     * Ajoute les attributs envoyés a la balise
     *
     * @param array $attributs Tableau associatif['class' => 'form-control','required' => true]
     * @return string Chaine de carractères générée
     */
    private function ajoutAttributs(array $attributs): string
    {
        // On initialise une chaine de caractères
        $str = '';

        // On liste les attributs'courts'
        $courts = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate'];

        // On fait une boucle sur le tableau d'attributs
        foreach ($attributs as $attribut => $valeur) {
            // si l'attribut est dan la liste des attributs courts   
            if (in_array($attribut, $courts)  && $valeur == true) {
                $str .= " $attribut";
            } else {
                // On ajoute attribut='valeur'
                $str .= " $attribut=\"$valeur\"";
            }
        }

        return $str;
    }



    /**
     * Balise d'ouverture du formulaire
     *
     * @param string $methode Méthode du formulaire (post ou get)
     * @param string $action action du formulaire
     * @param array $attributs Attributs
     * @return Form
     */
    public function debutForm(string $methode = 'post', string $action = '#', array $attributs = []): self
    {
        // On crée la balise form
        $this->formCode .= "<form action='$action' method='$methode'";

        // On ajoute les attributs éventuels
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) . '>' : '>';

        return $this;
    }

    /**
     * Balise de fermeture du formulaire
     *
     * @return Form
     */
    public function finForm(): self
    {
        $this->formCode .= "</form>";
        return $this;
    }


    /**
     * Ajout d'un label
     *
     * @param string $for Le for='...' du label
     * @param string $texte Le NOM que doit porter le label
     * @param array $attributs les attribut si il y'en a 
     * @return self
     */
    public function ajoutLabelFor(string $for, string $texte, array $attributs = []): self
    {
        // On ouvre la balise
        $this->formCode .= "<label for='$for'";

        // On ajoute les attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';

        // On ajoute le texte
        $this->formCode .= ">$texte</label>";

        return $this;
    }


    /**
     * Ajout d'un input
     *
     * @param string $type Le type de l'input
     * @param string $nom Le name de l'input
     * @param array $attributs Le tableau associatif des attributs si il y'en a 
     * @return self
     */
    public function ajoutInput(string $type, string $nom, array $attributs = []): self
    {
        // On ouvre la balise
        $this->formCode .= "<input type='$type' name='$nom'";
        // On ajoute les attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) . '>' : '>';
        return $this;
    }




    public function debutDiv(string $name=null): self
    {
        // On ouvre la balise
        $this->formCode .= "<div class='$name' ";
        // On ajoute les attributs
        $this->formCode .= '>';
        return $this;
    }


    public function finDiv(): self
    {
        // On ferme la balise
        $this->formCode .= "</div>";

        return $this;
    }




    /**
     * Ajout d'un textarea
     *
     * @param string $nom Le name du textarea
     * @param string $valeur
     * @param array $attributs Les attributs dans un tableau assossiatif
     * @return self
     */
    public function ajoutTextarea(string $nom, string $valeur = '', array $attributs = []): self
    {
        // On ouvre la balise
        $this->formCode .= "<textarea name='$nom'";

        // On ajoute les attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';

        // On ajoute le texte
        $this->formCode .= ">$valeur</textarea>";

        return $this;
    }



    /**
     * Ajout de select et des options
     *
     * @param string $nom Le name
     * @param array $options Le tableau des options
     * @param array $attributs les attribut en tableau associatif
     * @return self
     */
    public function ajoutSelect(string $nom, array $options, array $attributs = []): self
    {
        // On crée le select
        $this->formCode .= "<select name='$nom'";

        // On ajoute les attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) . '>' : '>';

        //On s'occupe des options
        foreach ($options as $valeur => $texte) {
            $this->formCode .= "<option value=\"$valeur\">$texte</option>";
        }

        //On ferme le select
        $this->formCode .= '</select>';
        return $this;
    }


    /**
     * Ajout Boutton de validation pour envoi du formulaire
     *
     * @param string $texte Le nom du boutton
     * @param array $attributs Tableau associatif pour les attributs
     * @return self
     */
    public function ajoutBouton(string $texte, array $attributs = []): self
    {
        // On ouvre la balise
        $this->formCode .= '<button ';

        // On ajoute les attributs si il y'en a
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';

        // On ajoute les texte et on ferme la balise
        $this->formCode .=  "><span>$texte</span></button>";

        return $this;
    }
}
