
!list_users
SELECT a.radacctid,a.username,a.acctstarttime,a.acctsessiontime,
(a.acctinputoctets+a.acctoutputoctets) AS traffic,
a.nasipaddress,a.framedipaddress,c.definitionname,d.id AS serid,d.acctype,f.orgname
FROM radacct a,acc_accseries d,acc_usagedefinition c,radcheck e,acc_isporg f
WHERE a.username=e.username
AND d.id=e.pacc_id_accseries
AND c.id=d.id_usagedefinition
AND d.id_isporg=f.id
AND e.attribute LIKE 'User-Password'
AND a.acctstoptime IS NULL
AND d.id_isporg = ?
ORDER BY a.acctstarttime DESC;

!del_record
UPDATE radacct
SET acctterminatecause='Session-Timeout',
acctstoptime=NOW()
WHERE radacctid=?;
