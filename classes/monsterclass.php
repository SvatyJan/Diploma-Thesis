<?php
class Monster
{
    private $id;
    private $monstername;
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
    private $spells = array();

    public function __construct($id, $monstername, $icon, $race, $maxhealth, $currenthealth, $strength, $agility, $intelligence, $armor, $magic_resist, $damage, $level)
    {
        $this->id = $id;
        $this->monstername = $monstername;
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

    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}
    public function getUsername(){return $this->monstername;}
    public function setUsername($monstername){$this->monstername = $monstername;}
    public function getIcon(){return $this->icon;}
    public function setIcon($icon){$this->icon = $icon;}
    public function getRace(){return $this->race;}
    public function setRace($race){$this->race = $race;}
    public function getMaxHealth(){return $this->maxhealth;}
    public function setMaxHealth($maxhealth){$this->maxhealth = $maxhealth;}
    public function getCurrentHealth(){return $this->currenthealth;}
    public function setCurrentHealth($currenthealth){$this->currenthealth = $currenthealth;}
    public function getStrength(){return $this->strength;}
    public function SetStrength($strength){$this->strength = $strength;}
    public function getAgility(){return $this->agility;}
    public function setAgility($agility){$this->agility = $agility;}
    public function getIntelligence(){return $this->intelligence;}
    public function setIntelligence($intelligence){$this->intelligence = $intelligence;}
    public function getArmor(){return $this->armor;}
    public function setArmor($armor){$this->armor = $armor;}
    public function getMagic_resist(){return $this->magic_resist;}
    public function setMagic_resist($magic_resist){$this->magic_resist = $magic_resist;}
    public function getDamage(){return $this->damage;}
    public function setDamage($damage){$this->damage = $damage;}
    public function getLevel(){return $this->level;}
    public function setLevel($level){$this->level = $level;}

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

    public function addItem(Item $item) {
        array_push($this->items, $item);
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

    public function addSpell(Spell $spell) {
        array_push($this->spells, $spell);
    }

    public function removeSpell(Spell $spell)
    {
        if (($key = array_search($spell, $this->spells)) !== false) {
            unset($this->spells[$key]);
        }
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getAllStats(){
        echo "Health: ".$this->getTotalHealth()."<br>";
        echo "Strength: ".$this->getTotalStrength()."<br>";
        echo "Agility: ".$this->getTotalAgility()."<br>";
        echo "Intelligence: ".$this->getTotalIntelligence()."<br>";
        echo "Damage: ".$this->getTotalDamage()."<br>";
        echo "Armor: ".$this->getTotalArmor()."<br>";
        echo "Magic Resit: ".$this->getTotalMagic_resist()."<br>";
    }

    public function prictiStatyItemu(){
        $this->getTotalHealth();
        $this->getTotalStrength();
        $this->getTotalAgility();
        $this->getTotalIntelligence();
        $this->getTotalDamage();
        $this->getTotalArmor();
        $this->getTotalMagic_resist();
    }

    public function getTotalHealth() {
        $totalHealth = $this->maxhealth;
        foreach ($this->items as $item) {$totalHealth += $item->getHealth();}
        return $totalHealth;
    }

    public function getTotalStrength() {
        $totalStrength = $this->strength;
        foreach ($this->items as $item) {$totalStrength += $item->getStrength();}
        return $totalStrength;
    }

    public function getTotalAgility() {
        $totalAgility = $this->agility;
        foreach ($this->items as $item) {$totalAgility += $item->getAgility();}
        return $totalAgility;
    }

    public function getTotalIntelligence() {
        $totalIntelligence = $this->intelligence;
        foreach ($this->items as $item) {$totalIntelligence += $item->getIntelligence();}
        return $totalIntelligence;
    }

    public function getTotalDamage() {
        $totalDamage = $this->damage;
        foreach ($this->items as $item) {$totalDamage += $item->getDamage();}
        return $totalDamage;
    }

    public function getTotalArmor() {
        $totalArmor = $this->armor;
        foreach ($this->items as $item) {$totalArmor += $item->getArmor();}
        return $totalArmor;
    }

    public function getTotalMagic_resist() {
        $totalMagic_Resist = $this->magic_resist;
        foreach ($this->items as $item) {$totalMagic_Resist += $item->getMagic_resist();}
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

    function createCharacterCard($monsterid){
        $monsterincard = MonsterFactory::createMonster($monsterid);
        $conn = mysqli_connect("localhost", "root", "", "bp");
        $gettargethp = Select("SELECT * FROM combat_has_monsters WHERE monsters_id_monster = ?",$monsterid,$conn)[0];
        $hpzdb = $gettargethp["currentHealth"];
        $monsterincard->setCurrentHealth($hpzdb);
        ?>
        <div class="combat-wrap-top" id="<?= $monsterincard->getUsernameWithoutBlankSpaces(); ?> <?= $monsterincard->getId(); ?>">
            <div class="combat-top ">
                <img class="combat-player-image" id="<?= $monsterincard->getUsernameWithoutBlankSpaces(); ?>" src="<?= "icons/".$monsterincard->getIcon(); ?>"
                     alt="<?= $monsterincard->getIcon(); ?>">
                <div class="combat-player-name">
                    <span><?= $monsterincard->getUsernameWithoutBlankSpaces(); ?><input  id="playerid <?= $monsterincard->getUsernameWithoutBlankSpaces(); ?>" type="hidden" value="<?= $monsterincard->getId()?>"/></span>
                    <span id="playercurrenthp" data-targetname="<?= $monsterincard->getUsernameWithoutBlankSpaces(); ?>"> <?=$monsterincard->getCurrentHealth();?> </span>
                    <span>/</span>
                    <span><?=$monsterincard->getTotalHealth(); ?></span>
                </div>
                <div class="combat-healtbar">
                    <div id="playerhealthbar" class="combat-bar" data-targetname="<?= $monsterincard->getUsernameWithoutBlankSpaces(); ?>" style="width:<?= $monsterincard->getCurrentHealth() / $monsterincard->getTotalHealth() * 100; ?>%;"></div>
                </div>
            </div>
            <div class="combat-bot">
                <div class="combat-bot-upper-actions">
                    <img id="<?= $monsterincard->getUsernameWithoutBlankSpaces(); ?>" class="combat-player-action action attack-button" data-action="attack" src="icons/broadsword.png" alt="icons/broadsword.png">
                    <img id="<?= $monsterincard->getUsernameWithoutBlankSpaces(); ?>" class="combat-player-action action wait-button" data-action="wait" src="icons/extra-time.png"alt="icons/extra-time.png">
                    <img id="<?= $monsterincard->getUsernameWithoutBlankSpaces(); ?>" class="combat-player-action action defend-button" data-action="defend" src="icons/viking-shield.png" alt="icons/viking-shield.png">
                </div>
                <div class="combat-bot-spells">
                    <img id="<?= $monsterincard->getUsernameWithoutBlankSpaces(); ?>" class="combat-player-action <?= ($monsterincard->getFirstSpellIcon()[0]) ? 'action' : 'disabled' ?>" data-action="spell1" src="<?= $monsterincard->getFirstSpellIcon()[1];;?>"
                         alt="icons/default.png">
                    <img id="<?= $monsterincard->getUsernameWithoutBlankSpaces(); ?>" class=" combat-player-action <?= ($monsterincard->getSecondSpellIcon()[0]) ? 'action' : 'disabled' ?>" data-action="spell2" src="<?= $monsterincard->getSecondSpellIcon()[1];?>"
                         alt="icons/default.png">
                    <img id="<?= $monsterincard->getUsernameWithoutBlankSpaces(); ?>" class=" combat-player-action <?= ($monsterincard->getThirdSpellIcon()[0]) ? 'action' : 'disabled' ?>" data-action="spell3" src="<?= $monsterincard->getThirdSpellIcon()[1];?>"
                         alt="icons/default.png">
                    <img id="<?= $monsterincard->getUsernameWithoutBlankSpaces(); ?>" class=" combat-player-action <?= ($monsterincard->getUltimateSpellIcon()[0]) ? 'action' : 'disabled' ?>" data-action="spell4" src="<?= $monsterincard->getUltimateSpellIcon()[1];?>"
                         alt="icons/default.png">
                </div>
                <div class="combat-bot-effects">
                    <img id="<?= $monsterincard->getUsername(); ?>" class="combat-effect effect <?= ($monsterincard->getPassiveSpellIcon()[0]) ? '' : 'hidden' ?>" src="<?= $monsterincard->getPassiveSpellIcon()[1];?>" alt="icons/default.png">
                </div>
            </div>
        </div>
        <?php
    }
}

class MonsterFactory
{
    public static function createMonster($vstupniidmonstra = NULL)
    {
        $conn = mysqli_connect("localhost", "root", "", "bp");

        $randommonstrum = 0;
        if ($vstupniidmonstra != NULL) {
            $kolikjemonstervdb = mysqli_query($conn, "SELECT * FROM Monsters WHERE id_monster = $vstupniidmonstra");
            if (mysqli_num_rows($kolikjemonstervdb) > 0) {
                $randommonstrum = $vstupniidmonstra;
            } else {
                $kolikjemonstervdb = mysqli_query($conn, "SELECT * FROM Monsters WHERE id_monster");
                $randommonstrum = mt_rand(1, mysqli_num_rows($kolikjemonstervdb));
            }
        } else {
            $kolikjemonstervdb = mysqli_query($conn, "SELECT * FROM Monsters WHERE id_monster");
            $randommonstrum = mt_rand(1, mysqli_num_rows($kolikjemonstervdb));
        }

        $monsters = mysqli_query($conn, "SELECT * FROM Monsters WHERE id_monster = $randommonstrum LIMIT 1");
        foreach ($monsters as $monster) {
            $monsterid = $monster["id_monster"];
            $monstername = $monster["monster_name"];
            $monstericonsrc = "icons/default.png";
            $getmonstericons = mysqli_query($conn, "SELECT * FROM Monsters JOIN image ON Image.id_image = Monsters.Image_id_image WHERE id_monster = $monsterid");
            foreach ($getmonstericons as $getmonsterico) {
                $monstericonsrc = $getmonsterico["source"];
            }
            $monsterrace = "";
            $getmonsterraces = mysqli_query($conn, "SELECT * FROM Monsters JOIN Race ON race.id_race = Monsters.Race_id_race WHERE id_monster = $monsterid");
            foreach ($getmonsterraces as $getmonsterrace) {
                $monsterrace = $getmonsterrace["racename"];
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
            $getmonsterstats = mysqli_query($conn, "SELECT * FROM monsters_has_stats JOIN stats ON monsters_has_stats.Stats_id_stats = stats.id_stats WHERE
 monsters_has_stats.Monsters_id_monster = $monsterid");
            foreach ($getmonsterstats as $getmonsterstat) {
                if ($getmonsterstat["statname"] == "health") {
                    $maxhealth = $getmonsterstat["value"];
                }
                if ($getmonsterstat["statname"] == "strength") {
                    $strength = $getmonsterstat["value"];
                }
                if ($getmonsterstat["statname"] == "agility") {
                    $agility = $getmonsterstat["value"];
                }
                if ($getmonsterstat["statname"] == "intelligence") {
                    $intelligence = $getmonsterstat["value"];
                }
                if ($getmonsterstat["statname"] == "armor") {
                    $armor = $getmonsterstat["value"];
                }
                if ($getmonsterstat["statname"] == "magic resist") {
                    $magic_resist = $getmonsterstat["value"];
                }
                if ($getmonsterstat["statname"] == "damage") {
                    $damage = $getmonsterstat["value"];
                }
                if ($getmonsterstat["statname"] == "level") {
                    $level = $getmonsterstat["value"];
                }
            }
            $monster = new Monster($monsterid, $monstername, $monstericonsrc, $monsterrace,
                $maxhealth, $currenthealth, $strength, $agility, $intelligence, $armor, $magic_resist, $damage, $level);

                        //TADY GENERUJU KOUZLA
                        //zjisti všechny kouzla které má hráč ve slotech: passive(1), combat(1),combat(2),combat(3), ultimate(1)
                        $getallmonsterspells = mysqli_query($conn, "SELECT * FROM monsters_has_spells JOIN Spellslots ON
                Spellslots.id_spellslots = monsters_has_spells.Spellslots_id_spellslots JOIN Spells ON
                spells.id_spells = monsters_has_spells.Spells_id_spells WHERE vJakemJeSlotu >= 1 AND Monsters_id_monster = $monsterid");

                        foreach ($getallmonsterspells as $getallmonsterspell) {
                            $spellid = $getallmonsterspell["Spells_id_spells"];
                            $spellname = $getallmonsterspell["spellname"];
                            $spellicon = "icons/default.png";
                            $vjakemjeslotu = $getallmonsterspell["vJakemJeSlotu"];
                            $getspellicons = mysqli_query($conn, "SELECT * FROM Spells JOIN Image ON Spells.Image_id_image = Image.id_image WHERE Spells.id_spells = $spellid");
                            foreach ($getspellicons as $getspellicon) {
                                $spellicon = $getspellicon["source"];
                            }
                            $spellslotname = $getallmonsterspell["spellslotname"];
                            $spellslotid = $getallmonsterspell["id_spellslots"];
                            $spelldescription = $getallmonsterspell["Description"] ?? "";

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

                            $spellcolldown = 0;
                            $getspellcooldowns = mysqli_query($conn, "SELECT * FROM Spells_has_Stats JOIN Stats ON
                    Stats.id_stats = Spells_has_stats.Stats_id_stats WHERE statname = 'cooldown' AND Spells_has_stats.Spells_id_spells = $spellid");
                            foreach ($getspellcooldowns as $getspellcooldown) {
                                if (count($getspellcooldown) > 0) {
                                    $spellcolldown = $getspellcooldown["value"] ?? 0;
                                }
                            }


                            $spell = new Spell($spellid, $spellname, $spellicon, $spellslotname, $vjakemjeslotu,
                                $spelldescription, $spellstrmultiplier, $spellagimultiplier, $spellintmultiplier, $spellcolldown);
                            $monster->addSpell($spell);

                        }
                    }

                    $monster->setCurrentHealth($monster->getTotalHealth());
                    return $monster;
        }
}

/*$monster = MonsterFactory::createMonster();
$monster->getAllStats();*/
?>