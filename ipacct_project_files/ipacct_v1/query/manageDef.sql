!sel_deflist
SELECT a.id,a.definitionname,a.acctype,a.pricebillingunit,a.id_isporg,b.orgname,
s1.value AS limittime,s2.value AS simuse,s3.value AS limitusageperiod,
s4.value AS limittraffic,s5.value AS limitdownloadrate,s6.value AS limitdaysofvalidity
FROM acc_usagedefinition a
LEFT JOIN acc_isporg b ON (a.id_isporg = b.id)
LEFT JOIN radgroupcheck s1 ON (a.id=s1.groupname::integer AND s1.attribute LIKE ?)
LEFT JOIN radgroupcheck s2 ON (a.id=s2.groupname::integer AND s2.attribute LIKE ?)
LEFT JOIN radgroupcheck s3 ON (a.id=s3.groupname::integer AND s3.attribute LIKE ?)
LEFT JOIN radgroupreply s4 ON (a.id=s4.groupname::integer AND s4.attribute LIKE ?)
LEFT JOIN radgroupreply s5 ON (a.id=s5.groupname::integer AND s5.attribute LIKE ?)
LEFT JOIN radgroupreply s6 ON (a.id=s6.groupname::integer AND s6.attribute LIKE ?)
WHERE a.id_isporg = ?;

!chk_serid
SELECT id
FROM acc_accseries
WHERE id_usagedefinition = ?;

!chk_postplog
SELECT id
FROM acc_postpaccountlog
WHERE id_usagedefinition = ?;

!del_definition
DELETE FROM acc_usagedefinition
WHERE id = ?;

!del_radusergroup
DELETE FROM radusergroup
WHERE groupname = ?;

!del_radgroupreply
DELETE FROM radgroupreply
WHERE groupname = ?;

!del_radgroupcheck
DELETE FROM radgroupcheck
WHERE groupname = ?;


