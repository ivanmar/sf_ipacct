!check_sameuser
SELECT id
FROM acc_systemuser
WHERE (id_isporg = ? OR username = 'sysadmin')
AND username = ?;

!sel_ispsuborg
SELECT id,suborgname
FROM acc_ispsuborg
WHERE id_isporg = ?
ORDER BY id;

!ins_user
INSERT INTO acc_systemuser (username, pass, acctype, id_isporg, name, email, phone, mobile,id_ispsuborg,lang)
VALUES (?,?,?,?,?,?,?,?,?,?);

!list_sysuser
SELECT a.id,a.username,a.acctype,a.name,a.email,a.phone,a.mobile,b.orgname
FROM acc_systemuser a, acc_isporg b
WHERE a.id_isporg = b.id
AND a.id_isporg = ?;

!check_user_series
SELECT id
FROM acc_accseries
WHERE id_systemuser = ?;

!check_postp_logs
SELECT id
FROM acc_postpaccountlog
WHERE id_systemuser = ?;

!check_prep_logs
SELECT id
FROM acc_prepaccount
WHERE id_systemuser = ?;

!del_sysuser
DELETE FROM acc_systemuser
WHERE id = ?;
