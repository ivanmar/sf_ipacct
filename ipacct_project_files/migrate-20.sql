ALTER TABLE acc_isporg RENAME COLUMN orgname TO name;

ALTER TABLE acc_ispsuborg RENAME COLUMN suborgname TO name;

ALTER TABLE nas RENAME COLUMN pacc_id_isporg TO id_isporg;
ALTER TABLE nas RENAME COLUMN pacc_id_ispsuborg TO id_ispsuborg;

ALTER TABLE radacct RENAME COLUMN radacctid TO id;

ALTER TABLE radcheck RENAME COLUMN attribute TO attr;
ALTER TABLE radcheck RENAME COLUMN pacc_id_accseries TO id_accseries;

ALTER TABLE radreply RENAME COLUMN attribute TO attr;

ALTER TABLE radgroupcheck RENAME COLUMN attribute TO attr;

ALTER TABLE radgroupreply RENAME COLUMN attribute TO attr;


