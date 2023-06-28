DELIMITER |
CREATE OR REPLACE TRIGGER characters_basics AFTER INSERT ON Characters FOR EACH ROW
BEGIN
    INSERT INTO characters_has_stats (Characters_id_character,Stats_id_stats,`value`)
    VALUES (NEW.id_character,1,100),(NEW.id_character,2,10),(NEW.id_character,3,10),(NEW.id_character,4,10),
           (NEW.id_character,5,10),(NEW.id_character,6,10),(NEW.id_character,7,10);
    INSERT INTO characters_has_spellslots (Characters_id_character,Spellslots_id_spellslots,Spells_id_spells) VALUES (NEW.id_character,1,NULL),(NEW.id_character,2,NULL),(NEW.id_character,3,NULL),(NEW.id_character,4,NULL);
END |
DELIMITER ;