!add_nas
INSERT INTO nas
(nasname,shortname,secret,pacc_id_isporg,pacc_id_ispsuborg,"type",pacc_conn_user,pacc_conn_pass,
pacc_admin_user,pacc_admin_pass,description,pacc_nasipaddress,pacc_macaddress,
pacc_ssid,pacc_radlocation,pacc_adminport)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);

!sel_ispsuborg
SELECT id,suborgname
FROM acc_ispsuborg
WHERE id_isporg = ?
ORDER BY id;

!sel_radloc_isp
SELECT radlocation FROM acc_isporg WHERE id=?;

!sel_radloc_sub
SELECT radlocation FROM acc_ispsuborg WHERE id_isporg=?;

!list_nas
SELECT a.id,a.nasname,a.pacc_nasipaddress,a.shortname,a.secret,a."type",a.pacc_ssid,a.description,b.orgname,c.suborgname
FROM nas a, acc_isporg b,acc_ispsuborg c
WHERE a.pacc_id_isporg = b.id
AND a.pacc_id_ispsuborg = c.id
ORDER BY shortname;

!del_nas
DELETE FROM nas
WHERE id = ?;
!sel_nasinfo
SELECT shortname,secret,pacc_ssid,pacc_conn_user,pacc_conn_pass,pacc_radlocation,
pacc_admin_user,pacc_admin_pass,description,pacc_ssid,pacc_adminport,pacc_macaddress
FROM nas
WHERE id =?;

!upd_nasinfo
UPDATE nas
SET pacc_macaddress=?,
shortname=?,
secret=?,
pacc_ssid=?,
pacc_adminport=?,
pacc_conn_user=?,
pacc_conn_pass=?,
pacc_admin_user=?,
pacc_admin_pass=?,
description=?
WHERE id = ?;
