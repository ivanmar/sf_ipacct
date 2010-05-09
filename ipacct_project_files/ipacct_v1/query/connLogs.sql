!sel_conn
SELECT a.radacctid,a.username,a.acctstarttime,a.acctsessiontime,
(a.acctinputoctets + a.acctoutputoctets) AS traffic,a.acctterminatecause,
a.nasipaddress,a.framedipaddress,b.id AS serid,b.acctype,c.definitionname,e.pacc_id_accseries,f.orgname
FROM radacct a,acc_accseries b,acc_usagedefinition c,radcheck e,acc_isporg f
WHERE a.username IN (SELECT username FROM radcheck)
AND a.username=e.username
AND b.id=e.pacc_id_accseries
AND c.id=b.id_usagedefinition
AND b.id_isporg=f.id
AND e.attribute LIKE 'User-Password'
AND a.username LIKE ?
AND b.id_isporg = ?
AND a.acctterminatecause LIKE ?
AND a.acctstarttime >= ?
AND a.acctstarttime <= ?
UNION
SELECT a.radacctid,a.username,a.acctstarttime,a.acctsessiontime,
(a.acctinputoctets + a.acctoutputoctets) AS traffic,a.acctterminatecause,
a.nasipaddress,a.framedipaddress,b.id AS serid,b.acctype,c.definitionname,e.id_accseries,f.orgname
FROM radacct a,acc_accseries b,acc_usagedefinition c,acc_prepaccount e,acc_isporg f
WHERE a.username NOT IN (SELECT username FROM radcheck)
AND a.username=e.username
AND b.id=e.id_accseries
AND c.id=b.id_usagedefinition
AND b.id_isporg=f.id
AND a.username LIKE ?
AND b.id_isporg = ?
AND a.acctterminatecause LIKE ?
AND a.acctstarttime >= ?
AND a.acctstarttime <= ?
ORDER BY acctstarttime DESC;

!del_record
DELETE FROM radacct
WHERE radacctid=?;

