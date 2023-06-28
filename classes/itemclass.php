<?php
class Item {
    private $id;
    private $itemname;
    private $isWeapon;
    private $isConsumable;
    private $isEquippable;
    private $itemicon;
    private $value;
    private $description;
    private $pocet;

    private $slotname;
    private $health;
    private $strength;
    private $agility;
    private $intelligence;
    private $damage;
    private $armor;
    private $magic_resist;
    private $isEquipped;


    public function __construct($id, $itemname, $isWeapon, $isConsumable, $isEquippable, $itemicon, $value, $description, $pocet, $slotname, $health, $strength, $agility, $intelligence, $damage, $armor,$magic_resist,$isEquipped)
    {
        $this->id = $id;
        $this->itemname = $itemname;
        $this->isWeapon = $isWeapon;
        $this->isConsumable = $isConsumable;
        $this->isEquippable = $isEquippable;
        $this->itemicon = $itemicon;
        $this->value = $value;
        $this->description = $description;
        $this->pocet = $pocet;
        $this->slotname = $slotname;
        $this->health = $health;
        $this->strength = $strength;
        $this->agility = $agility;
        $this->intelligence = $intelligence;
        $this->damage = $damage;
        $this->armor = $armor;
        $this->magic_resist = $magic_resist;
        $this->isEquipped = $isEquipped;
    }

    public function getId() {return $this->id;}
    public function setId($id) {$this->id = $id;}

    public function getItemname() {return $this->itemname;}
    public function setItemname($itemname) {$this->itemname = $itemname;}

    public function getIsWeapon() {return $this->isWeapon;}
    public function setIsWeapon($isWeapon) {$this->isWeapon = $isWeapon;}

    public function getIsConsumable() {return $this->isConsumable;}
    public function setIsConsumable($isConsumable) {$this->isConsumable = $isConsumable;}

    public function getIsEquippable() {return $this->isEquippable;}
    public function setIsEquippable($isEquippable) {$this->isEquippable = $isEquippable;}

    public function getItemicon() {return $this->itemicon;}
    public function setItemicon($itemicon) {$this->itemicon = $itemicon;}

    public function getValue() {return $this->value;}
    public function setValue($value) {$this->value = $value;}

    public function getDescription() {return $this->description;}
    public function setDescription($description) {$this->description = $description;}

    public function getPocet() {return $this->pocet;}
    public function setPocet($pocet) {$this->pocet = $pocet;}

    public function getSlotname() {return $this->slotname;}
    public function setSlotname($slotname) {$this->slotname = $slotname;}

    public function getHealth() {return $this->health;}
    public function setHealth($health) {$this->health = $health;}

    public function getStrength() {return $this->strength;}
    public function setStrenght($strength) {$this->strength = $strength;}

    public function getAgility() {return $this->agility;}
    public function setAgility($agility) {$this->agility = $agility;}

    public function getIntelligence() {return $this->intelligence;}
    public function setIntelligence($intelligence) {$this->intelligence = $intelligence;}

    public function getDamage() {return $this->damage;}
    public function setDamage($damage) {$this->damage = $damage;}

    public function getArmor() {return $this->armor;}
    public function setArmor($armor) {$this->armor = $armor;}

    public function getMagic_resist() {return $this->magic_resist;}
    public function setMagic_resist($magic_resist) {$this->magic_resist = $magic_resist;}

    public function getIsEquipped() {return $this->isEquipped;}
    public function setIsEquipped($isEquipped) {$this->isEquipped = $isEquipped;}

    public function getItemStats(){
        $itemstats = array();
        array_push($itemstats,$this->getHealth(), $this->getStrength(), $this->getAgility(), $this->getIntelligence(),
        $this->getDamage(), $this->getArmor(), $this->getMagic_resist());
        return $itemstats;
    }

    public function getItemStatsAsString(){
        $itemstats = "Damage: ".$this->getDamage()."<br>".
        "Health :".$this->getHealth()."<br>"
        ."Strength: ".$this->getStrength()."<br>"
            ."Agility: ".$this->getAgility()."<br>"
            ."Intelligence: ".$this->getIntelligence()."<br>"
            ."Armor: ".$this->getArmor()."<br>"
            ."Magic resist: ".$this->getMagic_resist()."<br>";
        echo $itemstats;
    }

    public function getAllStats(){
        echo "Health: ".$this->getHealth()."<br>";
        echo "Strength: ".$this->getStrength()."<br>";
        echo "Agility: ".$this->getAgility()."<br>";
        echo "Intelligence: ".$this->getIntelligence()."<br>";
        echo "Damage: ".$this->getDamage()."<br>";
        echo "Armor: ".$this->getArmor()."<br>";
        echo "Magic Resit: ".$this->getMagic_resist()."<br>";
    }

}

    //Vytváření items array = všechny instance předmětů z databáze
    //TOTO JE REDUNDANTNÍ ŘEŠENÍ, MÍSTO TOHO BUDU VYHLEDÁVAT POUZE PŘEDMĚTY KTERÉ MÁ HRÁČ A MÁ JE OBLEČENÉ
    $items= array();
    $conn = mysqli_connect("localhost", "root", "", "bp");
    $getitems = mysqli_query($conn,"SELECT * FROM Items JOIN image ON items.Image_id_image = image.id_image JOIN itemslots ON itemslots.id_Itemslots = items.ItemSlots_id_ItemSlots");
    foreach ($getitems as $getitem){
        $itemid = $getitem["id_item"];
        $itemname = $getitem["itemname"];
        $itemisweapon = $getitem["isWeapon"];
        $itemisconsumable = $getitem["isConsumable"];
        $itemisequippable = $getitem["isEquippable"];
        $itemimagesrc = "icons/".$getitem["source"];
        $itemimagealt = $getitem["alt"];
        $itemvalue = $getitem["Value"];
        $itemdescription = $getitem["Description"];
        $itemslotname = $getitem["slotname"];
        $itempocet = 1;

        $itemhealth = 0;
        $itemstrength = 0;
        $itemagility = 0;
        $itemintelligence = 0;
        $itemdamage = 0;
        $itemarmor = 0;
        $itemmagic_resist = 0;
        $isEquipped = 0;

        $getitemstats = Select("SELECT * FROM items_has_stats JOIN stats ON items_has_stats.Stats_id_stats = stats.id_stats WHERE items_has_stats.Items_id_item = ?", $itemid, $conn);
        foreach ($getitemstats as $getitemstat){
            if($getitemstat["statname"] == "health"){$itemhealth = $getitemstat["value"];}
            if($getitemstat["statname"] == "strength"){$itemstrength = $getitemstat["value"];}
            if($getitemstat["statname"] == "agility"){$itemagility = $getitemstat["value"];}
            if($getitemstat["statname"] == "intelligence"){$itemintelligence = $getitemstat["value"];}
            if($getitemstat["statname"] == "damage"){$itemdamage = $getitemstat["value"];}
            if($getitemstat["statname"] == "armor"){$itemarmor = $getitemstat["value"];}
            if($getitemstat["statname"] == "magic_resist"){$itemmagic_resist = $getitemstat["value"];}
        }
        $item = new Item($itemid, $itemname,$itemisweapon,$itemisconsumable,$itemisequippable,$itemimagesrc,$itemvalue,
            $itemdescription,$itempocet, $itemslotname,$itemhealth,$itemstrength,$itemagility,$itemintelligence,$itemdamage,$itemarmor,$itemmagic_resist,$isEquipped);
        array_push($items,$item);
    }
    //print_r($items);
?>