<?php
$player->getAllItems();
$allitems = $player->getAllItems();
?>

<div class="inventory-container">
    <?php foreach ($allitems as $allitem) {?>
        <div class="inventory">
            <a class="inventory-item">
                <div class="inventory-item-pocet"><?=$allitem->getPocet();?></div>

                <img onclick='openModal("<?=$allitem->getId();?>","<?= $allitem->getItemicon();?>","<?= $allitem->getItemname();?>",
                        "<?= $allitem->getValue();?>","<?= $allitem->getDescription();?>","<?= $allitem->getItemStatsAsString();?>",
                        "<?= $allitem->getIsEquippable();?>","<?= $allitem->getIsEquipped();?>")'
                     class="inventory-item-icon <?php if($allitem->getIsEquipped() > 0){ echo "isEquippedeffect";} ?>" src="<?php echo $allitem->getItemicon(); ?>">
            </a>
        </div>
    <?php } ?>
</div>

<div id="my-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="id" class="hidden">1</div>
        <div class="modal-container">
            <div class="ikonka      modal-item" id="ikonka"><img id="itemicon" src="icons/default.png" alt="default"></div>
            <div class="nazev       modal-item" id="nazev"></div>
            <div class="hodnota     modal-item" id="hodnota"></div>
            <div class="atributy    modal-item" id="atributy"></div>
            <div class="description modal-item" id="description"></div>
            <div class="equip       modal-item" id="equip"><a id="modal-equip-button" class="modal-equip-button" href="" >Equip</a></div>
        </div>
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("my-modal");

    let itemid = document.querySelector('#id');
    let ikonka = document.querySelector('#ikonka');
    let nazev = document.querySelector('#nazev');
    let hodnota = document.querySelector('#hodnota');
    let description = document.querySelector('#description');
    let atributy = document.querySelector('#atributy');


    function openModal(newitemid, newikonka, newnazev, newhodnota, newdescription, newatributy, newisequippable, newisequipped) {
        itemid.innerHTML = newitemid;
        nazev.innerHTML = newnazev;
        hodnota.innerHTML = "Value: <span class='currency'>" + newhodnota + "</span>";
        description.innerHTML = newdescription;
        atributy.innerHTML = newatributy;
        document.getElementById("itemicon").src = newikonka;

        console.log(newisequippable);

        if(newisequippable == 1 && newisequipped == 0){
            document.getElementById("modal-equip-button").href = "scripts/equipitem.php?&itemid="+newitemid;
            document.getElementById("modal-equip-button").classList.remove("hidden");
            document.getElementById("modal-equip-button").innerHTML = "Equip";
        }else if (newisequippable == 1 && newisequipped == 1){
            document.getElementById("modal-equip-button").href = "scripts/unequipitem.php?&itemid="+newitemid;
            document.getElementById("modal-equip-button").innerHTML = "Unequip";
            document.getElementById("modal-equip-button").classList.remove("hidden");
        } else {
            document.getElementById("modal-equip-button").classList.add("hidden");
        }

        document.getElementById("my-modal").style.display = "block";
    }
    function closeModal() {
        document.getElementById("my-modal").style.display = "none";
    }
</script>
