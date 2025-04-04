DELIMITER $$

CREATE TRIGGER update_stock_status_before_insert
BEFORE INSERT ON stck
FOR EACH ROW
BEGIN
    SET NEW.remarks = CASE
                        WHEN NEW.num_stck = 0 THEN 'No available stock'
                        WHEN NEW.num_stck <= 32 THEN 'Low stock'
                        ELSE 'In stock'
                      END;
END $$

DELIMITER ;
