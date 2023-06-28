<?php
/* Co všechno potřebuju??*/
//ID, jmeno, ikonka_hrace
//rasa
//STATY: health, strength, agility, intelligence, armor, magic resist, damage, level
//INVENTAR (všechny equipnuté předměty a jejich staty přičíst ke statům)

//KOUZLA: passive, first, second, third ,forth
class Character
{
    private $id;
    private $username;
    private $icon;
    private $race;
    private $maxhealth;
    private $currenthealth;
    private $strength;
    private $agility;
    private $intelligence;
    private $armor;
    private $magic_resist;
    private $damage;
    private $level;

    private $items = array();
    private $allitems = array();
    private $spells = array();
    private $allspells = array();

    public function __construct($id, $username, $icon, $race, $maxhealth, $currenthealth, $strength, $agility, $intelligence, $armor, $magic_resist, $damage, $level)
    {
        $this->id = $id;
        $this->username = $username;
        $this->icon = $icon;
        $this->race = $race;
        $this->maxhealth = $maxhealth;
        $this->currenthealth = $currenthealth;
        $this->strength = $strength;
        $this->agility = $agility;
        $this->intelligence = $intelligence;
        $this->armor = $armor;
        $this->magic_resist = $magic_resist;
        $this->damage = $damage;
        $this->level = $level;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    public function getRace()
    {
        return $this->race;
    }

    public function setRace($race)
    {
        $this->race = $race;
    }

    public function getMaxHealth()
    {
        return $this->maxhealth;
    }

    public function setMaxHealth($maxhealth)
    {
        $this->maxhealth = $maxhealth;
    }

    public function getCurrentHealth()
    {
        return $this->currenthealth;
    }

    public function setCurrentHealth($currenthealth)
    {
        $this->currenthealth = $currenthealth;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function SetStrength($strength)
    {
        $this->strength = $strength;
    }

    public function getAgility()
    {
        return $this->agility;
    }

    public function setAgility($agility)
    {
        $this->agility = $agility;
    }

    public function getIntelligence()
    {
        return $this->intelligence;
    }

    public function setIntelligence($intelligence)
    {
        $this->intelligence = $intelligence;
    }

    public function getArmor()
    {
        return $this->armor;
    }

    public function setArmor($armor)
    {
        $this->armor = $armor;
    }

    public function getMagic_resist()
    {
        return $this->magic_resist;
    }

    public function setMagic_resist($magic_resist)
    {
        $this->magic_resist = $magic_resist;
    }

    public function getDamage()
    {
        return $this->damage;
    }

    public function setDamage($damage)
    {
        $this->damage = $damage;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function takeDamage($damage)
    {
        if ($this->currenthealth - $damage < 0) {
            $this->currenthealth = 0;
        } else {
            $this->currenthealth -= $damage;
        }
    }

    public function heal($heal)
    {
        if ($this->currenthealth + $heal > $this->maxhealth) {
            $this->currenthealth = $this->maxhealth;
        } else {
            $this->currenthealth += $heal;
        }
    }

    public function isAlive()
    {
        return $this->currenthealth > 0;
    }

    public function addItem(Item $item)
    {
        array_push($this->items, $item);
    }

    public function getItems()
    {
        return $this->items;
    }

    public function addAllItem(Item $item){
        array_push($this->allitems, $item);
    }

    public function getAllItems()
    {
        return $this->allitems;
    }

    public function removeItem(Item $item)
    {
        if (($key = array_search($item, $this->items)) !== false) {
            unset($this->items[$key]);
        }
    }

    public function getSpells()
    {
        return $this->spells;
    }

    public function addSpell(Spell $spell)
    {
        array_push($this->spells, $spell);
    }

    public function addALLSpell(Spell $spell)
    {
        array_push($this->allspells, $spell);
    }

    public function removeSpell(Spell $spell)
    {
        if (($key = array_search($spell, $this->spells)) !== false) {
            unset($this->spells[$key]);
        }
    }

    public function getAllSpells()
    {
        return $this->allspells;
    }


    public function getAllStats()
    {
        echo "Health: " . $this->getTotalHealth() . "<br>";
        echo "Strength: " . $this->getTotalStrength() . "<br>";
        echo "Agility: " . $this->getTotalAgility() . "<br>";
        echo "Intelligence: " . $this->getTotalIntelligence() . "<br>";
        echo "Damage: " . $this->getTotalDamage() . "<br>";
        echo "Armor: " . $this->getTotalArmor() . "<br>";
        echo "Magic Resit: " . $this->getTotalMagic_resist() . "<br>";
    }

    public function prictiStatyItemu()
    {
        $this->getTotalHealth();
        $this->getTotalStrength();
        $this->getTotalAgility();
        $this->getTotalIntelligence();
        $this->getTotalDamage();
        $this->getTotalArmor();
        $this->getTotalMagic_resist();
    }

    public function getTotalHealth()
    {
        $totalHealth = $this->maxhealth;
        foreach ($this->items as $item) {
            $totalHealth += $item->getHealth();
        }
        return $totalHealth;
    }

    public function getTotalStrength()
    {
        $totalStrength = $this->strength;
        foreach ($this->items as $item) {
            $totalStrength += $item->getStrength();
        }
        return $totalStrength;
    }

    public function getTotalAgility()
    {
        $totalAgility = $this->agility;
        foreach ($this->items as $item) {
            $totalAgility += $item->getAgility();
        }
        return $totalAgility;
    }

    public function getTotalIntelligence()
    {
        $totalIntelligence = $this->intelligence;
        foreach ($this->items as $item) {
            $totalIntelligence += $item->getIntelligence();
        }
        return $totalIntelligence;
    }

    public function getTotalDamage()
    {
        $totalDamage = $this->damage;
        foreach ($this->items as $item) {
            $totalDamage += $item->getDamage();
        }
        return $totalDamage;
    }

    public function getTotalArmor()
    {
        $totalArmor = $this->armor;
        foreach ($this->items as $item) {
            $totalArmor += $item->getArmor();
        }
        return $totalArmor;
    }

    public function getTotalMagic_resist()
    {
        $totalMagic_Resist = $this->magic_resist;
        foreach ($this->items as $item) {
            $totalMagic_Resist += $item->getMagic_resist();
        }
        return $totalMagic_Resist;
    }

    public function getPassiveSpellIcon() {
        $spellExists = false;
        foreach ($this->spells as $spell) {
            if ($spell->getSpellslot() == "passive" && $spell->getvJakemJeSlotu() == 1) {
                $spellExists = true;
                $spellIcon =  "icons/".$spell->getIcon();
                return array($spellExists, $spellIcon);
            }
        }
        return array($spellExists, "icons/default.png");
    }

    public function getFirstSpellIcon() {
        $spellExists = false;
        foreach ($this->spells as $spell) {
            if ($spell->getSpellslot() == "combat" && $spell->getvJakemJeSlotu() == 1) {
                $spellExists = true;
                $spellIcon =  "icons/".$spell->getIcon();
                return array($spellExists, $spellIcon);
            }
        }
        return array($spellExists, "icons/default.png");
    }

    public function getSecondSpellIcon() {
        $spellExists = false;
        foreach ($this->spells as $spell) {
            if ($spell->getSpellslot() == "combat" && $spell->getvJakemJeSlotu() == 2) {
                $spellExists = true;
                $spellIcon =  "icons/".$spell->getIcon();
                return array($spellExists, $spellIcon);
            }
        }
        return array($spellExists, "icons/default.png");
    }

    public function getThirdSpellIcon() {
        $spellExists = false;
        foreach ($this->spells as $spell) {
            if ($spell->getSpellslot() == "combat" && $spell->getvJakemJeSlotu() == 3) {
                $spellExists = true;
                $spellIcon =  "icons/".$spell->getIcon();
                return array($spellExists, $spellIcon);
            }
        }
        return array($spellExists, "icons/default.png");
    }

    public function getUltimateSpellIcon() {
        $spellExists = false;
        foreach ($this->spells as $spell) {
            if ($spell->getSpellslot() == "ultimate" && $spell->getvJakemJeSlotu() == 1) {
                $spellExists = true;
                $spellIcon =  "icons/".$spell->getIcon();
                return array($spellExists, $spellIcon);
            }
        }
        return array($spellExists, "icons/default.png");
    }

    public function getUsernameWithoutBlankSpaces(){
        $username = $this->getUsername();
        $newusername = str_replace(" ", "_", $username);
        return $newusername;
    }

    function attack($attacker, $defender) {
        $damage = $attacker->getTotalDamage();
        $defender->setCurrentHealth($defender->getCurrentHealth() - $damage);
    }


    function createCharacterCard($playerid){
        $conn = mysqli_connect("localhost", "root", "", "bp");
        $playerincard = PlayerFactory::createPlayer($playerid);
        $gettargethp = Select("SELECT * FROM combat_has_characters WHERE characters_id_character = ?",$playerid,$conn)[0];
        $hpzdb = $gettargethp["currentHealth"];
        $playerincard->setCurrentHealth($hpzdb);

        ?>
        <div class="combat-wrap-top" id="<?= $playerincard->getUsernameWithoutBlankSpaces(); ?> <?= $playerincard->getId(); ?>">
            <div class="combat-top ">
                <img class="combat-player-image" id="<?= $playerincard->getUsernameWithoutBlankSpaces(); ?>" src="<?= "icons/".$playerincard->getIcon(); ?>"
                     alt="<?= $playerincard->getIcon(); ?>">
                <div class="combat-player-name">
                    <span><?= $playerincard->getUsernameWithoutBlankSpaces(); ?><input class="playerid" id="playerid <?= $playerincard->getUsernameWithoutBlankSpaces(); ?>" type="hidden" value="<?= $playerincard->getId()?>"/></span>
                    <span id="playercurrenthp" data-targetname="<?= $playerincard->getUsernameWithoutBlankSpaces(); ?>"> <?=$playerincard->getCurrentHealth();?> </span>
                    <span>/</span>
                    <span><?=$playerincard->getTotalHealth(); ?></span>
                </div>
                <div class="combat-healtbar">
                    <div id="playerhealthbar" class="combat-bar" data-targetname="<?= $playerincard->getUsernameWithoutBlankSpaces(); ?>" style="width:<?= $playerincard->getCurrentHealth() / $playerincard->getTotalHealth() * 100; ?>%;"></div>
                </div>
            </div>
            <div class="combat-bot">
                <div class="combat-bot-upper-actions">
                    <img id="<?= $playerincard->getUsernameWithoutBlankSpaces(); ?>" class="combat-player-action action attack-button" data-action="attack" src="icons/broadsword.png" alt="icons/broadsword.png">
                    <img id="<?= $playerincard->getUsernameWithoutBlankSpaces(); ?>" class="combat-player-action action wait-button" data-action="wait" src="icons/extra-time.png"alt="icons/extra-time.png">
                    <img id="<?= $playerincard->getUsernameWithoutBlankSpaces(); ?>" class="combat-player-action action defend-button" data-action="defend" src="icons/viking-shield.png" alt="icons/viking-shield.png">
                </div>
                <div class="combat-bot-spells">
                    <img id="<?= $playerincard->getUsernameWithoutBlankSpaces(); ?>" class="combat-player-action <?= ($playerincard->getFirstSpellIcon()[0]) ? 'action' : 'disabled' ?>" data-action="spell1" src="<?= $playerincard->getFirstSpellIcon()[1];;?>"
                         alt="icons/default.png">
                    <img id="<?= $playerincard->getUsernameWithoutBlankSpaces(); ?>" class=" combat-player-action <?= ($playerincard->getSecondSpellIcon()[0]) ? 'action' : 'disabled' ?>" data-action="spell2" src="<?= $playerincard->getSecondSpellIcon()[1];?>"
                         alt="icons/default.png">
                    <img id="<?= $playerincard->getUsernameWithoutBlankSpaces(); ?>" class=" combat-player-action <?= ($playerincard->getThirdSpellIcon()[0]) ? 'action' : 'disabled' ?>" data-action="spell3" src="<?= $playerincard->getThirdSpellIcon()[1];?>"
                         alt="icons/default.png">
                    <img id="<?= $playerincard->getUsernameWithoutBlankSpaces(); ?>" class=" combat-player-action <?= ($playerincard->getUltimateSpellIcon()[0]) ? 'action' : 'disabled' ?>" data-action="spell4" src="<?= $playerincard->getUltimateSpellIcon()[1];?>"
                         alt="icons/default.png">
                </div>
                <div class="combat-bot-effects">
                    <img id="<?= $playerincard->getUsername(); ?>" class="combat-effect effect <?= ($playerincard->getPassiveSpellIcon()[0]) ? '' : 'hidden' ?>" src="<?= $playerincard->getPassiveSpellIcon()[1];?>" alt="icons/default.png">
                </div>
            </div>
        </div>
        <?php
    }

}

class PlayerFactory
{
    public static function createPlayer($id)
    {
        $conn = mysqli_connect("localhost", "root", "", "bp");
        $characters = mysqli_query($conn, "SELECT * FROM Characters WHERE id_character = $id LIMIT 1");
        foreach ($characters as $character) {
            $characterid = $character["id_character"];
            $charactername = $character["username"];
            $charactericonsrc = "icons/default.png";
            $getcharactericon = mysqli_query($conn, "SELECT * FROM Characters JOIN image ON Image.id_image = characters.Image_id_image WHERE id_character = $id");
            foreach ($getcharactericon as $charactericon) {
                $charactericonsrc = $charactericon["source"];
            }
            $characterrace = "";
            $getcharacterraces = mysqli_query($conn, "SELECT * FROM Characters JOIN Race ON race.id_race = Characters.Race_id_race WHERE id_character = $id");
            foreach ($getcharacterraces as $getcharacterrace) {
                $characterrace = $getcharacterrace["racename"];
            }

            $maxhealth = 100;
            $currenthealth = $maxhealth;
            $strength = 10;
            $agility = 10;
            $intelligence = 10;
            $armor = 10;
            $magic_resist = 10;
            $damage = 10;
            $level = 1;
            $getcharacterstats = mysqli_query($conn, "SELECT * FROM characters_has_stats JOIN stats ON characters_has_stats.Stats_id_stats = stats.id_stats WHERE
 characters_has_stats.Characters_id_character = $id");
            foreach ($getcharacterstats as $getcharacterstat) {
                if ($getcharacterstat["statname"] == "health") {
                    $maxhealth = $getcharacterstat["value"];
                }
                if ($getcharacterstat["statname"] == "strength") {
                    $strength = $getcharacterstat["value"];
                }
                if ($getcharacterstat["statname"] == "agility") {
                    $agility = $getcharacterstat["value"];
                }
                if ($getcharacterstat["statname"] == "intelligence") {
                    $intelligence = $getcharacterstat["value"];
                }
                if ($getcharacterstat["statname"] == "armor") {
                    $armor = $getcharacterstat["value"];
                }
                if ($getcharacterstat["statname"] == "magic resist") {
                    $magic_resist = $getcharacterstat["value"];
                }
                if ($getcharacterstat["statname"] == "damage") {
                    $damage = $getcharacterstat["value"];
                }
                if ($getcharacterstat["statname"] == "level") {
                    $level = $getcharacterstat["value"];
                }
            }
            $player = new Character($characterid, $charactername, $charactericonsrc, $characterrace,
                $maxhealth, $currenthealth, $strength, $agility, $intelligence, $armor, $magic_resist, $damage, $level);

            //TADY GENERUJU ITEMY
            //zjisti všechny předměty které má hráč oblečené
            $getcharacteritems = mysqli_query($conn, "SELECT * FROM characters_has_items WHERE isEquipped = 1 AND characters_has_items.Characters_id_character = $id
            LIMIT 10");
            foreach ($getcharacteritems as $getcharacteritem) {
                $itemid = $getcharacteritem["Items_id_item"];
                $itemname = "";
                $itemisweapon = "";
                $itemisconsumable = "";
                $itemisequippable = "";
                $itemvalue = "";
                $itemdescription = "";
                $itemimageid = "";
                $itemslotid = "";
                $itempocet = 1;
                $isEquipped = $getcharacteritem["isEquipped"];

                $getitems = mysqli_query($conn, "SELECT * FROM Items WHERE id_item = $itemid");
                foreach ($getitems as $getitem) {
                    $itemname = $getitem["itemname"];
                    $itemisweapon = $getitem["isWeapon"];
                    $itemisconsumable = $getitem["isConsumable"];
                    $itemisequippable = $getitem["isEquippable"];
                    $itemvalue = $getitem["Value"];
                    $itemdescription = $getitem["Description"];
                    $itemimageid = $getitem["Image_id_image"];
                    $itemslotid = $getitem["ItemSlots_id_ItemSlots"];
                }


                $itemimagesrc = "icons/default.png";
                $getitemimagesources = mysqli_query($conn, "SELECT * FROM Items JOIN Image ON Items.Image_id_image = Image.id_image WHERE id_item = $itemid");
                foreach ($getitemimagesources as $getitemimagesource) {
                    if (count($getitemimagesource) > 0) {
                        $itemimagesrc = "icons/" . $getitemimagesource["source"];
                        $itemimagealt = $getitemimagesource["alt"];
                    }
                }


                $itemslotname = "";
                $getitemslotnames = mysqli_query($conn, "SELECT * FROM Items JOIN Itemslots ON Items.ItemSlots_id_ItemSlots = Itemslots.id_Itemslots WHERE id_item = $itemid");
                foreach ($getitemslotnames as $getitemslotname) {
                    if (count($getitemslotname) > 0) {
                        $itemslotname = $getitemslotname["slotname"];
                    }
                }

                $itemhealth = 0;
                $itemstrength = 0;
                $itemagility = 0;
                $itemintelligence = 0;
                $itemdamage = 0;
                $itemarmor = 0;
                $itemmagic_resist = 0;

                //jednotlive selectnout všechny atributy z db
                $itemhealthselects = mysqli_query($conn, "SELECT * FROM `Items_has_Stats` JOIN
        stats ON Items_has_Stats.Stats_id_stats = stats.id_stats WHERE stats.statname = 'health' AND items_has_stats.Items_id_item = $itemid");
                foreach ($itemhealthselects as $itemhealthselect) {
                    if (count($itemhealthselect) > 0) {
                        $itemhealth = $itemhealthselect["value"];
                    }
                }


                $itemstrengthselects = mysqli_query($conn, "SELECT * FROM `Items_has_Stats` JOIN
        stats ON Items_has_Stats.Stats_id_stats = stats.id_stats WHERE stats.statname = 'strength' AND items_has_stats.Items_id_item = $itemid");
                foreach ($itemstrengthselects as $itemstrengthselect) {
                    if (count($itemstrengthselect) > 0) {
                        $itemstrength = $itemstrengthselect["value"];
                    }
                }

                $itemagilityselects = mysqli_query($conn, "SELECT * FROM `Items_has_Stats` JOIN
        stats ON Items_has_Stats.Stats_id_stats = stats.id_stats WHERE stats.statname = 'agility' AND items_has_stats.Items_id_item = $itemid");
                foreach ($itemagilityselects as $itemagilityselect) {
                    if (count($itemagilityselect) > 0) {
                        $itemagility = $itemagilityselect["value"];
                    }
                }


                $itemintelligenceselects = mysqli_query($conn, "SELECT * FROM `Items_has_Stats` JOIN
        stats ON Items_has_Stats.Stats_id_stats = stats.id_stats WHERE stats.statname = 'intelligence' AND items_has_stats.Items_id_item = $itemid");
                foreach ($itemintelligenceselects as $itemintelligenceselect) {
                    if (count($itemintelligenceselect) > 0) {
                        $itemintelligence = $itemintelligenceselect["value"];
                    }
                }

                $itemdamageselects = mysqli_query($conn, "SELECT * FROM `Items_has_Stats` JOIN
        stats ON Items_has_Stats.Stats_id_stats = stats.id_stats WHERE stats.statname = 'damage' AND items_has_stats.Items_id_item = $itemid");
                foreach ($itemdamageselects as $itemdamageselect) {
                    if (count($itemdamageselect) > 0) {
                        $itemdamage = $itemdamageselect["value"];
                    }
                }

                $itemarmorselects = mysqli_query($conn, "SELECT * FROM `Items_has_Stats` JOIN
        stats ON Items_has_Stats.Stats_id_stats = stats.id_stats WHERE stats.statname = 'armor' AND items_has_stats.Items_id_item = $itemid");
                foreach ($itemarmorselects as $itemarmorselect) {
                    if (count($itemarmorselect) > 0) {
                        $itemarmor = $itemarmorselect["value"];
                    }
                }


                $itemmagic_resistselects = mysqli_query($conn, "SELECT * FROM `Items_has_Stats` JOIN
        stats ON Items_has_Stats.Stats_id_stats = stats.id_stats WHERE stats.statname = 'magic resist' AND items_has_stats.Items_id_item = $itemid");
                foreach ($itemmagic_resistselects as $itemmagic_resistselect) {
                    if (count($itemmagic_resistselect) > 0) {
                        $itemmagic_resist = $itemmagic_resistselect["value"];
                    }
                }


                $item = new Item($itemid, $itemname, $itemisweapon, $itemisconsumable, $itemisequippable, $itemimagesrc, $itemvalue,
                    $itemdescription,$itempocet, $itemslotname, $itemhealth, $itemstrength, $itemagility, $itemintelligence, $itemdamage, $itemarmor, $itemmagic_resist,$isEquipped);
                $player->addItem($item);
                $player->prictiStatyItemu();
            }

            /// TADY GENERUJU VŠECHNY ITEMY, ne jen oblečené
            $getcharacterALLitems = mysqli_query($conn, "SELECT * FROM characters_has_items WHERE  characters_has_items.Characters_id_character = $id");
            foreach ($getcharacterALLitems as $getcharacterALLitem) {
                $ALLitemid = $getcharacterALLitem["Items_id_item"];
                $ALLitemname = "";
                $ALLitemisweapon = "";
                $ALLitemisconsumable = "";
                $ALLitemisequippable = "";
                $ALLitemvalue = "";
                $ALLitemdescription = "";
                $ALLitemimageid = "";
                $ALLitemslotid = "";
                $ALLitemisEquipped = $getcharacterALLitem["isEquipped"];
                $ALLitempocet = $getcharacterALLitem["pocet"];
                $getALLitems = mysqli_query($conn, "SELECT * FROM Items WHERE id_item = $ALLitemid");
                foreach ($getALLitems as $getALLitem) {
                    $ALLitemname = $getALLitem["itemname"];
                    $ALLitemisweapon = $getALLitem["isWeapon"];
                    $ALLitemisconsumable = $getALLitem["isConsumable"];
                    $ALLitemisequippable = $getALLitem["isEquippable"];
                    $ALLitemvalue = $getALLitem["Value"];
                    $ALLitemdescription = $getALLitem["Description"];
                    $ALLitemimageid = $getALLitem["Image_id_image"];
                    $ALLitemslotid = $getALLitem["ItemSlots_id_ItemSlots"];
                }


                $ALLitemimagesrc = "icons/default.png";
                $getALLitemimagesources = mysqli_query($conn, "SELECT * FROM Items JOIN Image ON Items.Image_id_image = Image.id_image WHERE id_item = $ALLitemid");
                foreach ($getALLitemimagesources as $getALLitemimagesource) {
                    if (count($getALLitemimagesource) > 0) {
                        $ALLitemimagesrc = "icons/" . $getALLitemimagesource["source"];
                        $ALLitemimagealt = $getALLitemimagesource["alt"];
                    }
                }
                $ALLitemslotname = "";
                $getALLitemslotnames = mysqli_query($conn, "SELECT * FROM Items JOIN Itemslots ON Items.ItemSlots_id_ItemSlots = Itemslots.id_Itemslots WHERE id_item = $ALLitemid");
                foreach ($getALLitemslotnames as $getALLitemslotname) {
                    if (count($getALLitemslotname) > 0) {
                        $ALLitemslotname = $getALLitemslotname["slotname"];
                    }
                }
                $ALLitemhealth = 0;
                $ALLitemstrength = 0;
                $ALLitemagility = 0;
                $ALLitemintelligence = 0;
                $ALLitemdamage = 0;
                $ALLitemarmor = 0;
                $ALLitemmagic_resist = 0;

                //jednotlive selectnout všechny atributy z db
                $ALLitemhealthselects = mysqli_query($conn, "SELECT * FROM `Items_has_Stats` JOIN
        stats ON Items_has_Stats.Stats_id_stats = stats.id_stats WHERE stats.statname = 'health' AND items_has_stats.Items_id_item = $ALLitemid");
                foreach ($ALLitemhealthselects as $ALLitemhealthselect) {
                    if (count($ALLitemhealthselect) > 0) {
                        $ALLitemhealth = $ALLitemhealthselect["value"];
                    }
                }
                $ALLitemstrengthselects = mysqli_query($conn, "SELECT * FROM `Items_has_Stats` JOIN
        stats ON Items_has_Stats.Stats_id_stats = stats.id_stats WHERE stats.statname = 'strength' AND items_has_stats.Items_id_item = $ALLitemid");
                foreach ($ALLitemstrengthselects as $ALLitemstrengthselect) {
                    if (count($ALLitemstrengthselect) > 0) {
                        $ALLitemstrength = $ALLitemstrengthselect["value"];
                    }
                }
                $ALLitemagilityselects = mysqli_query($conn, "SELECT * FROM `Items_has_Stats` JOIN
        stats ON Items_has_Stats.Stats_id_stats = stats.id_stats WHERE stats.statname = 'agility' AND items_has_stats.Items_id_item = $ALLitemid");
                foreach ($ALLitemagilityselects as $ALLitemagilityselect) {
                    if (count($ALLitemagilityselect) > 0) {
                        $ALLitemagility = $ALLitemagilityselect["value"];
                    }
                }
                $ALLitemintelligenceselects = mysqli_query($conn, "SELECT * FROM `Items_has_Stats` JOIN
        stats ON Items_has_Stats.Stats_id_stats = stats.id_stats WHERE stats.statname = 'intelligence' AND items_has_stats.Items_id_item = $ALLitemid");
                foreach ($ALLitemintelligenceselects as $ALLitemintelligenceselect) {
                    if (count($ALLitemintelligenceselect) > 0) {
                        $ALLitemintelligence = $ALLitemintelligenceselect["value"];
                    }
                }
                $ALLitemdamageselects = mysqli_query($conn, "SELECT * FROM `Items_has_Stats` JOIN
        stats ON Items_has_Stats.Stats_id_stats = stats.id_stats WHERE stats.statname = 'damage' AND items_has_stats.Items_id_item = $ALLitemid");
                foreach ($ALLitemdamageselects as $ALLitemdamageselect) {
                    if (count($ALLitemdamageselect) > 0) {
                        $ALLitemdamage = $ALLitemdamageselect["value"];
                    }
                }
                $ALLitemarmorselects = mysqli_query($conn, "SELECT * FROM `Items_has_Stats` JOIN
        stats ON Items_has_Stats.Stats_id_stats = stats.id_stats WHERE stats.statname = 'armor' AND items_has_stats.Items_id_item = $ALLitemid");
                foreach ($ALLitemarmorselects as $ALLitemarmorselect) {
                    if (count($ALLitemarmorselect) > 0) {
                        $ALLitemarmor = $ALLitemarmorselect["value"];
                    }
                }
                $ALLitemmagic_resistselects = mysqli_query($conn, "SELECT * FROM `Items_has_Stats` JOIN
        stats ON Items_has_Stats.Stats_id_stats = stats.id_stats WHERE stats.statname = 'magic resist' AND items_has_stats.Items_id_item = $ALLitemid");
                foreach ($ALLitemmagic_resistselects as $ALLitemmagic_resistselect) {
                    if (count($ALLitemmagic_resistselect) > 0) {
                        $ALLitemmagic_resist = $ALLitemmagic_resistselect["value"];
                    }
                }
                $allitem = new Item($ALLitemid, $ALLitemname, $ALLitemisweapon, $ALLitemisconsumable, $ALLitemisequippable, $ALLitemimagesrc, $ALLitemvalue,
                    $ALLitemdescription, $ALLitempocet, $ALLitemslotname, $ALLitemhealth, $ALLitemstrength, $ALLitemagility, $ALLitemintelligence, $ALLitemdamage, $ALLitemarmor,
                    $ALLitemmagic_resist,$ALLitemisEquipped);
                $player->addAllItem($allitem);
            }


            //TADY GENERUJU KOUZLA
            //zjisti všechny kouzla které má hráč ve slotech: passive(1), combat(1),combat(2),combat(3), ultimate(1)
            $getallplayerspells = mysqli_query($conn, "SELECT * FROM characters_has_spells JOIN Spellslots ON
    Spellslots.id_spellslots = characters_has_spells.Spellslots_id_spellslots JOIN Spells ON
    spells.id_spells = characters_has_spells.Spells_id_spells WHERE vJakemJeSlotu >= 1 AND Characters_id_character = $id");

            foreach ($getallplayerspells as $getallplayerspell) {
                $spellid = $getallplayerspell["Spells_id_spells"];
                $spellname = $getallplayerspell["spellname"];
                $spellicon = "icons/default.png";
                $vjakemjeslotu = $getallplayerspell["vJakemJeSlotu"];
                $getspellicons = mysqli_query($conn, "SELECT * FROM Spells JOIN Image ON Spells.Image_id_image = Image.id_image WHERE Spells.id_spells = $spellid");
                foreach ($getspellicons as $getspellicon) {
                    $spellicon = $getspellicon["source"];
                }
                $spellslotname = $getallplayerspell["spellslotname"];
                $spellslotid = $getallplayerspell["id_spellslots"];
                $spelldescription = $getallplayerspell["Description"] ?? "";

                //jednotlive staty
                $spellstrmultiplier = 0;
                $getspellstrmultipliers = mysqli_query($conn, "SELECT * FROM Spells_has_Stats JOIN Stats ON 
        Stats.id_stats = Spells_has_stats.Stats_id_stats WHERE statname = 'strmultiplier' AND Spells_has_stats.Spells_id_spells = $spellid");
                foreach ($getspellstrmultipliers as $getspellstrmultiplier) {
                    if (count($getspellstrmultiplier) > 0) {
                        $spellstrmultiplier = $getspellstrmultiplier["value"] ?? 0;
                    }
                }


                $spellagimultiplier = 0;
                $getspellagimultipliers = mysqli_query($conn, "SELECT * FROM Spells_has_Stats JOIN Stats ON 
        Stats.id_stats = Spells_has_stats.Stats_id_stats WHERE statname = 'agimultiplier' AND Spells_has_stats.Spells_id_spells = $spellid");
                foreach ($getspellagimultipliers as $getspellagimultiplier) {
                    if (count($getspellagimultiplier) > 0) {
                        $spellagimultiplier = $getspellagimultiplier["value"] ?? 0;
                    }
                }


                $spellintmultiplier = 0;
                $getspellintmultipliers = mysqli_query($conn, "SELECT * FROM Spells_has_Stats JOIN Stats ON 
        Stats.id_stats = Spells_has_stats.Stats_id_stats WHERE statname = 'intmultiplier' AND Spells_has_stats.Spells_id_spells = $spellid");
                foreach ($getspellintmultipliers as $getspellintmultiplier) {
                    if (count($getspellintmultiplier) > 0) {
                        $spellintmultiplier = $getspellintmultiplier["value"] ?? 0;
                    }
                }

                $spellcooldown = 0;
                $getspellcolldowns = mysqli_query($conn, "SELECT * FROM Spells_has_Stats JOIN Stats ON 
        Stats.id_stats = Spells_has_stats.Stats_id_stats WHERE statname = 'cooldown' AND Spells_has_stats.Spells_id_spells = $spellid");
                foreach ($getspellcolldowns as $getspellcolldown) {
                    if (count($getspellcolldown) > 0) {
                        $spellcooldown = $getspellcolldown["value"] ?? 0;
                    }
                }


                $spell = new Spell($spellid, $spellname, $spellicon, $spellslotname, $vjakemjeslotu,
                    $spelldescription, $spellstrmultiplier, $spellagimultiplier, $spellintmultiplier, $spellcooldown);
                $player->addSpell($spell);

            }
        }

        /* GET ALL SPELLS IN SPELLBOOK*/
        $getallspellsinspellbooks = mysqli_query($conn, "SELECT * FROM characters_has_spells JOIN Spellslots ON
    Spellslots.id_spellslots = characters_has_spells.Spellslots_id_spellslots JOIN Spells ON
    spells.id_spells = characters_has_spells.Spells_id_spells WHERE Characters_id_character = $id");

        foreach ($getallspellsinspellbooks as $getallspellsinspellbook) {
            $ALLspellid = $getallspellsinspellbook["Spells_id_spells"];
            $ALLspellname = $getallspellsinspellbook["spellname"];
            $ALLspellicon = "icons/default.png";
            $ALLvjakemjeslotu = $getallspellsinspellbook["vJakemJeSlotu"];
            $ALLgetspellbookicons = mysqli_query($conn, "SELECT * FROM Spells JOIN Image ON Spells.Image_id_image = Image.id_image WHERE Spells.id_spells = $ALLspellid");
            foreach ($ALLgetspellbookicons as $getspellbookicon) {
                $ALLspellicon = $getspellbookicon["source"];
            }
            $ALLspellslotname = $getallspellsinspellbook["spellslotname"];
            $ALLspellslotid = $getallspellsinspellbook["id_spellslots"];
            $ALLspelldescription = $getallspellsinspellbook["Description"] ?? "";

            //jednotlive staty
            $ALLspellstrmultiplier = 0;
            $ALLgetspellstrmultipliers = mysqli_query($conn, "SELECT * FROM Spells_has_Stats JOIN Stats ON 
        Stats.id_stats = Spells_has_stats.Stats_id_stats WHERE statname = 'strmultiplier' AND Spells_has_stats.Spells_id_spells = $ALLspellid");
            foreach ($ALLgetspellstrmultipliers as $ALLgetspellstrmultiplier) {
                if (count($ALLgetspellstrmultiplier) > 0) {
                    $ALLspellstrmultiplier = $ALLgetspellstrmultiplier["value"] ?? 0;
                }
            }


            $ALLspellagimultiplier = 0;
            $ALLgetspellagimultipliers = mysqli_query($conn, "SELECT * FROM Spells_has_Stats JOIN Stats ON 
        Stats.id_stats = Spells_has_stats.Stats_id_stats WHERE statname = 'agimultiplier' AND Spells_has_stats.Spells_id_spells = $ALLspellid");
            foreach ($ALLgetspellagimultipliers as $ALLgetspellagimultiplier) {
                if (count($ALLgetspellagimultiplier) > 0) {
                    $ALLspellagimultiplier = $ALLgetspellagimultiplier["value"] ?? 0;
                }
            }


            $ALLspellintmultiplier = 0;
            $ALLgetspellintmultipliers = mysqli_query($conn, "SELECT * FROM Spells_has_Stats JOIN Stats ON 
        Stats.id_stats = Spells_has_stats.Stats_id_stats WHERE statname = 'intmultiplier' AND Spells_has_stats.Spells_id_spells = $ALLspellid");
            foreach ($ALLgetspellintmultipliers as $ALLgetspellintmultiplier) {
                if (count($ALLgetspellintmultiplier) > 0) {
                    $ALLspellintmultiplier = $ALLgetspellintmultiplier["value"] ?? 0;
                }
            }


            $ALLspell = new Spell($ALLspellid, $ALLspellname, $ALLspellicon, $ALLspellslotname, $ALLvjakemjeslotu,
                $ALLspelldescription,$ALLitempocet, $ALLspellstrmultiplier, $ALLspellagimultiplier, $ALLspellintmultiplier);
            $player->addALLSpell($ALLspell);

        }


        $player->setCurrentHealth($player->getTotalHealth());

        return $player;
    }
}

//$player = PlayerFactory::createPlayer($id);



/*
 * UKÁZKA ŠABLONY
$player = new Character(1, "Jan", "default.png","human",100,10,10,10,10,10,10,1);
print_r($player);
*/
?>