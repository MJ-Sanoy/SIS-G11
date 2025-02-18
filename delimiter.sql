DELIMITER $$

CREATE TRIGGER update_stock_status_after_update
AFTER UPDATE ON stck
FOR EACH ROW
BEGIN
    IF NEW.num_stck != OLD.num_stck THEN
        UPDATE stck
        SET remarks = CASE
                            WHEN NEW.num_stck = 0 THEN 'No available stock'
                            WHEN NEW.num_stck <= 32 THEN 'Low stock'
                            WHEN NEW.num_stck > 32 THEN 'In stock'
                          END
        WHERE product_id = NEW.product_id;
    END IF;
END $$

DELIMITER ;