!get_isp
SELECT id,orgname
FROM acc_isporg
ORDER BY id;

!get_user_info
SELECT a.id,a.username,a.pass,a.acctype,a.id_isporg,a.id_ispsuborg,a.lang,b.orgname,b.email_nasadmin,c.suborgname
FROM acc_systemuser a,acc_isporg b,acc_ispsuborg c
WHERE a.id_isporg = b.id
AND a.id_ispsuborg = c.id
AND a.id_isporg	= ?
AND a.username = ?;

!get_user_info_adm
SELECT a.id,a.username,a.pass,a.acctype,a.id_isporg,a.id_ispsuborg,a.lang,b.orgname,b.email_nasadmin,c.suborgname
FROM acc_systemuser a,acc_isporg b,acc_ispsuborg c
WHERE a.id_isporg = b.id
AND a.id_ispsuborg = c.id
AND a.username = ?;

!get_orgname_adm
SELECT orgname
FROM acc_isporg
WHERE id = ?;
