<?php
require_once 'Model.php';

class CountryModel extends Model
{

    protected $id;
    protected $name;
    protected $capitalCity;
    protected $continent;
    protected $flagImage;
    protected $countryMapImage;
    protected $population;
    protected $area;
    protected $currency;
    protected $description;


    public function __construct()
    {
        $this->table = 'country';
    }



    public function search(string $search)
    {
        return $this->requete("SELECT * FROM $this->table WHERE name LIKE ? ORDER BY name LIMIT 4", [$search . '%'])->fetchAll();
    }


    public function searchSuggestion(string $search)
    {
        return $this->requete("SELECT * FROM $this->table WHERE name LIKE ? ORDER BY name ", ['%' . $search . '%'])->fetchAll();
    }


    public function singleElement($id)
    {
        return $this->requete("SELECT * FROM $this->table WHERE id = ?", [$id])->fetch();
    }






    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of capitalCity
     */
    public function getCapitalCity()
    {
        return $this->capitalCity;
    }

    /**
     * Set the value of capitalCity
     *
     * @return  self
     */
    public function setCapitalCity($capitalCity)
    {
        $this->capitalCity = $capitalCity;

        return $this;
    }

    /**
     * Get the value of continent
     */
    public function getContinent()
    {
        return $this->continent;
    }

    /**
     * Set the value of continent
     *
     * @return  self
     */
    public function setContinent($continent)
    {
        $this->continent = $continent;

        return $this;
    }

    /**
     * Get the value of flagImage
     */
    public function getFlagImage()
    {
        return $this->flagImage;
    }

    /**
     * Set the value of flagImage
     *
     * @return  self
     */
    public function setFlagImage($flagImage)
    {
        $this->flagImage = $flagImage;

        return $this;
    }

    /**
     * Get the value of countryMapImage
     */
    public function getCountryMapImage()
    {
        return $this->countryMapImage;
    }

    /**
     * Set the value of countryMapImage
     *
     * @return  self
     */
    public function setCountryMapImage($countryMapImage)
    {
        $this->countryMapImage = $countryMapImage;

        return $this;
    }


    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}
