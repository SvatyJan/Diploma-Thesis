<div class="profile-inventory-wrap">
    <?php
    if ($id == $hisid) {

        foreach ($itemy as $item) {
            $imgsource = "icons/" . $item["source"];

            $itemid = $item["id_item"];
            $itemystaty = Select("SELECT * FROM Items_has_stats LEFT JOIN stats ON id_stats = Stats_id_stats WHERE Items_id_item = ?", $itemid, $conn);
            $itemstats = "";

            foreach ($itemystaty as $itemstat) {
                $itemstatname = $itemstat["statname"];
                $itemstatvalue = $itemstat["value"];
                $itemstats = $itemstats.$itemstatvalue . " " . $itemstatname;
            }
            $slotid = $item["id_Itemslots"];
            $equipitemtext = "Equip";
            if($item["isEquipped"] === 0){
                $equipitemtext = "Equip";
            } else{
                $equipitemtext = "Unequip";
            }
            $equipItemUrl = "scripts/equipitem.php?id=$id&itemid=$itemid";

            if($slotid != 0){
                $equippedItems = Select("SELECT * FROM Characters_has_items LEFT JOIN items ON items.id_item = Characters_has_items.Items_id_item LEFT JOIN image ON image.id_image = items.Image_id_image
WHERE Characters_has_items.Itemslots_id_itemslots = $slotid AND Characters_has_items.isEquipped = 1 AND Characters_has_items.Characters_id_character = ?",$_SESSION["id"],$conn);
                if(@$equippedItems[0]["source"] == ""){$equippedSrc = "icons/default.png";}
                else{
                    $equippedSrc = "icons/".$equippedItems[0]["source"];
                }
            }
            else{
                $equippedSrc = "icons/default.png";
            }

            $isEquippable = $item["isEquippable"];
            $isConsumable = $item["isConsumable"];

            //echo $item["pocet"];

            if($isEquippable === 0 && $isConsumable === 0){
                ?><div class="profile-inventory-item-wrap">
                <div class="profile-inventory-item-count"><?= $item["pocet"];?></div>
                <img class='profile-inventory-item' style="border: 2px solid yellow" onclick='OpenModal("<?= $itemid ?>","<?= $item["itemname"] ?>","<?= $item["Value"] ?>","<?= $itemstats ?>","Description","<?= $imgsource ?>","<?= $item["slotname"] ?>","<?= $equippedSrc; ?>","<?= $equipitemtext;?>","<?= $equipItemUrl;?>","<?= $isEquippable; ?>")' src='<?= $imgsource ?>' alt='<?= $item["alt"] ?>'>
                </div><?php
            }else if($item["isEquipped"] === 1){
                ?><div class="profile-inventory-item-wrap">
        <div class="profile-inventory-item-count"><?= $item["pocet"];?></div>
        <img class='profile-inventory-item' style="border: 2px solid red;" onclick='OpenModal("<?= $itemid ?>","<?= $item["itemname"] ?>","<?= $item["Value"] ?>","<?= $itemstats ?>","Description","<?= $imgsource ?>","<?= $item["slotname"] ?>","<?= $equippedSrc; ?>","<?= $equipitemtext;?>","<?= $equipItemUrl;?>","<?= $isEquippable; ?>")' src='<?= $imgsource ?>' alt='<?= $item["alt"] ?>'>
                </div><?php
            }else if($item["isEquipped"] === 0) {
            ?>
            <div class="profile-inventory-item-wrap">
            <div class="profile-inventory-item-count"><?= $item["pocet"];?></div>
            <img class='profile-inventory-item' style="border: 2px solid green" onclick='OpenModal("<?= $itemid ?>","<?= $item["itemname"] ?>","<?= $item["Value"] ?>","<?= $itemstats ?>","Description","<?= $imgsource ?>","<?= $item["slotname"] ?>","<?= $equippedSrc; ?>","<?= $equipitemtext;?>","<?= $equipItemUrl;?>","<?= $isEquippable; ?>")' src='<?= $imgsource ?>' alt='<?= $item["alt"] ?>'>
            </div><?php
            }
        }
        ?>
        <div class='profile-inventory-wrap'>
            <dialog class="modal">
                <div class="modal-top">
                    <img class="modal-top-icon" id="modal-top-icon" src="icons/default.png" alt="icons/default.png">
                    <div class="modal-top-right">
                        <div class="item-name">Sword</div>
                        <div class="item-id">1</div>
                        <div class="item-cost">10 gold</div>
                    </div>
                </div>
                <div class="modal-description-stats">
                    <p>Damage : 10</p>
                </div>
                <hr>
                <div class="modal-itemslot">
                    <p>None</p>
                </div>
                <div class="modal-description">
                    <p>Basic training sword</p>
                </div>
                <div class="modal-actions">
                    <div class="modal-actions-left">
                        <img class="modal-actions-icons" id="first-item" src="icons/default.png">
                        <p class="modal-actions-arrow">&#8594;</p>
                        <img class="modal-actions-icons" id="second-item" src="icons/default.png">
                    </div>
                    <div class="modal-actions-right">
                        <p>stats +</p>
                        <p>stats -</p>
                    </div>
                </div>
                <div class="modal-actions-interact">
                    <button onclick="GoToURL(itemurl)" class="modal-equip-button">Equip</button>
                    <div aria-label="hidden" style="display: none;" class="hidden-element">itemurl</div>
                </div>
                <div onclick="CloseModal()" class="modal-close">
                    <button>Back</button>
                </div>
            </dialog>
            <script>
                let modal = document.querySelector('.modal');

                let itemid = document.querySelector('.item-id');
                let itemname = document.querySelector('.item-name');
                let itemcost = document.querySelector('.item-cost');
                let itemstats = document.querySelector('.modal-description-stats');
                let itemdescription = document.querySelector('.modal-description');
                let itemslot = document.querySelector('.modal-itemslot');
                let itemisequipped = document.querySelector('.modal-equip-button');
                let itemurl = document.querySelector('.hidden-element');
                let isEquippable = "";

                function OpenModal(newitemid, newitemname, newitemcost, newitemstats, newitemdescription, newitemicon, newitemslot, newseconditemicon, newitemisequipped, newitemurl, newisEquippable){
                    itemid.innerHTML = newitemid;
                    itemname.innerHTML = newitemname;
                    itemcost.innerHTML = newitemcost;
                    itemstats.innerHTML = newitemstats;
                    itemdescription.innerHTML = newitemdescription;
                    itemslot.innerHTML = newitemslot;
                    itemisequipped.innerHTML = newitemisequipped;
                    document.getElementById("modal-top-icon").src = newitemicon;
                    document.getElementById("first-item").src = newitemicon;
                    document.getElementById("second-item").src = newseconditemicon;
                    itemurl.innerHTML = newitemurl;

                    isEquippable = newisEquippable;

                    /*if(isEquippable == 0){
                        //document.getElementsByClassName(".modal-actions-interact").style.display ="none";
                        //document.getElementById('.modal-equip-button').style.visibility = 'hidden';
                        console.log(isEquippable);
                    }*/
                    modal.showModal();
                }

                function GoToURL(itemurl){
                    //console.log(itemurl);
                    location.href = itemurl.innerHTML.replace("amp;", "");
                }

                function CloseModal(){
                    modal.close();
                }

            </script>
        </div>
        <?php
    }
    ?>
    </div>
</div>
