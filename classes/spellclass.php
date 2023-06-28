<?php
class Spell {
    private $id;
    private $spellname;
    private $icon;
    private $spellslot;
    private $vJakemJeSlotu;
    private $description;
    private $strengthmultiplier;
    private $agilitymultiplier;
    private $intelligencemultiplier;
    private $cooldown;

    public function __construct($id, $spellname, $icon, $spellslot, $vJakemJeSlotu, $description, $strengthmultiplier, $agilitymultiplier, $intelligencemultiplier, $cooldown)
    {
        $this->id = $id;
        $this->spellname = $spellname;
        $this->icon = $icon;
        $this->spellslot = $spellslot;
        $this->vJakemJeSlotu = $vJakemJeSlotu;
        $this->description = $description;
        $this->strengthmultiplier = $strengthmultiplier;
        $this->agilitymultiplier = $agilitymultiplier;
        $this->intelligencemultiplier = $intelligencemultiplier;
        $this->cooldown = $cooldown;
    }

    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}
    public function getSpellname(){return $this->spellname;}
    public function setSpellname($spellname){$this->spellname = $spellname;}
    public function getIcon(){return $this->icon;}
    public function setIcon($icon){$this->icon = $icon;}
    public function getSpellslot(){return $this->spellslot;}
    public function setSpellslot($spellslot){$this->spellslot = $spellslot;}
    public function getvJakemJeSlotu(){return $this->vJakemJeSlotu;}
    public function setvJakemJeSlotu($vJakemJeSlotu){$this->vJakemJeSlotu = $vJakemJeSlotu;}
    public function getDescription(){return $this->description;}
    public function setDescription($description){$this->description = $description;}
    public function getStrengthmultiplier(){return $this->strengthmultiplier;}
    public function setStrengthmultiplier($strengthmultiplier){$this->strengthmultiplier = $strengthmultiplier;}
    public function getAgilitymultiplier(){return $this->agilitymultiplier;}
    public function setAgilitymultiplier($agilitymultiplier){$this->agilitymultiplier = $agilitymultiplier;}
    public function getIntelligencemultiplier(){return $this->intelligencemultiplier;}
    public function setIntelligencemultiplier($intelligencemultiplier){$this->intelligencemultiplier = $intelligencemultiplier;}
    public function getCooldown(){return $this->cooldown;}
    public function setCooldown($cooldown){$this->cooldown = $cooldown;}

    public function getAllStats(){
        echo "Strength multiplier: ".$this->getStrengthmultiplier()."<br>";
        echo "Agility multiplier: ".$this->getAgilitymultiplier()."<br>";
        echo "Intelligence multiplier: ".$this->getIntelligencemultiplier()."<br>";
        echo "Cooldown: ".$this->getCooldown()."<br>";
    }

}

//$spell1 = new Spell(1,"Fireball", "icons/default.png", "combat","Shoots a ball of fire",0,0,0.7);


?>