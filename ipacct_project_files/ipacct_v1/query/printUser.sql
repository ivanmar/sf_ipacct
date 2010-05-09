!sel_series
SELECT id_isporg,id_ispsuborg,id_accseries
FROM acc_postpaccount
WHERE username LIKE ?;

!sel_accinfo
SELECT a.crdate,b.definitionname,b.limitdownloadrate,b.limituploadrate,
b.limittraffic,b.limittime,b.limitdaysofvalidity,
b.limitusageperiod,c.username,c.value AS password
FROM acc_accseries a,acc_usagedefinition b,radcheck c
WHERE a.id_usagedefinition=b.id
AND a.id=c.pacc_id_accseries
AND c.attribute LIKE 'User-Password'
AND c.username LIKE ?
AND c.pacc_id_accseries=?;

