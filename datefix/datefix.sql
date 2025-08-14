USE RF_WORLD

ALTER TABLE tbl_base DROP CONSTRAINT DF_tbl_base_LastConnTime;
ALTER TABLE tbl_base ALTER COLUMN [LastConnTime] bigint NOT NULL;
ALTER TABLE tbl_base ADD CONSTRAINT DF_tbl_base_LastConnTime DEFAULT (0) FOR [LastConnTime];

ALTER TABLE tbl_racebattle_log ALTER COLUMN [endtime] bigint NOT NULL;

ALTER TABLE tbl_supplement DROP CONSTRAINT DF__tbl_supplement_BufEndTime;
ALTER TABLE tbl_supplement ALTER COLUMN [BufEndTime] bigint NOT NULL;
ALTER TABLE tbl_supplement ADD CONSTRAINT DF__tbl_supplement_BufEndTime DEFAULT (0) FOR [BufEndTime];

ALTER TABLE tbl_TimeLimitInfo DROP CONSTRAINT DF_tbl_TimeLimitInfo_LastLoginTime;
ALTER TABLE tbl_TimeLimitInfo ALTER COLUMN [LastLogoutTime] bigint NOT NULL;
ALTER TABLE tbl_TimeLimitInfo ADD CONSTRAINT DF_tbl_TimeLimitInfo_LastLoginTime DEFAULT (101010000) FOR [LastLogoutTime];

UPDATE tbl_base SET [LastConnTime] = 2201010000 WHERE [LastConnTime] = 2147483647
UPDATE tbl_TimeLimitInfo SET [LastLogoutTime] = 2201010000 WHERE [LastLogoutTime] = 2147483647