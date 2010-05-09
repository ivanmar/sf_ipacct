!get_user_info
SELECT a.id,a.username,a.pass,a.acctype,a.id_isporg,a.id_ispsuborg,b.orgname
FROM acc_systemuser a,acc_isporg b
WHERE a.id_isporg = b.id
AND a.id = ?;

!upd_pass
UPDATE acc_systemuser
SET pass=?
WHERE id=?;