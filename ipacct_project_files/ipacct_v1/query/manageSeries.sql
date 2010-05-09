!sel_series
SELECT a.id,a.crdate,a.nraccount,a.id_isporg,
a.acctype,b.definitionname,b.pricebillingunit,c.orgname,d.username
FROM acc_accseries a,acc_usagedefinition b,acc_isporg c,acc_systemuser d
WHERE a.id_usagedefinition=b.id
AND a.id_isporg=c.id
AND a.id_systemuser=d.id
AND a.id_isporg = ?
AND a.acctype = ?
ORDER BY a.crdate DESC;

!check_postplog
SELECT a.id
FROM acc_postpaccountlog a,acc_postpaccount b
WHERE a.id_postpaccount=b.id
AND b.id_accseries = ?;

!check_preplog
SELECT id
FROM acc_prepaccount
WHERE id_accseries = ?
AND datesale IS NOT NULL;


!del_postpaccount
DELETE FROM acc_postpaccount
WHERE id_accseries = ?;

!del_prepaccount
DELETE FROM acc_prepaccount
WHERE id_accseries = ?;

!del_subinfo
DELETE FROM acc_subscriberinfo
WHERE id_accseries = ?;

!del_radreply
DELETE FROM radreply
WHERE username IN (SELECT username
FROM radcheck
WHERE attribute='User-Password'
AND pacc_id_accseries = ?);

!del_radacct
DELETE FROM radacct
WHERE username IN (SELECT username
FROM radcheck
WHERE attribute='User-Password'
AND pacc_id_accseries = ?);

!del_usergroup
DELETE FROM radusergroup
WHERE username IN (SELECT username
FROM radcheck
WHERE attribute='User-Password'
AND pacc_id_accseries = ?);

!del_radcheck
DELETE FROM radcheck
WHERE username IN (SELECT username
FROM radcheck
WHERE attribute='User-Password'
AND pacc_id_accseries = ?);

!del_series
DELETE FROM acc_accseries
WHERE id = ?;

