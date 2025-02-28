DELIMITER $$

CREATE TRIGGER update_stock_status_after_update
BEFORE UPDATE ON stck -- Change from AFTER UPDATE to BEFORE UPDATE
FOR EACH ROW
BEGIN
    IF NEW.num_stck != OLD.num_stck THEN
        SET NEW.remarks = CASE
                            WHEN NEW.num_stck = 0 THEN 'No available stock'
                            WHEN NEW.num_stck <= 32 THEN 'Low stock'
                            WHEN NEW.num_stck > 32 THEN 'In stock'
                          END;
    END IF;
END $$

DELIMITER ;