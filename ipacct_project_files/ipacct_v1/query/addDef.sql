!add_def
INSERT INTO acc_usagedefinition
(definitionname,acctype,id_isporg,measureunit,billingunit,pricebillingunit,priceonstart)
VALUES(?,?,?,?,?,?,?);

!add_radcheck
INSERT INTO radgroupcheck (groupname, attribute, op, value)
VALUES (?,?,?,?);

!add_radreply
INSERT INTO radgroupreply (groupname, attribute, op, value)
VALUES (?,?,?,?);
!sel_definfo
SELECT a.id,a.definitionname,a.acctype,a.pricebillingunit,a.id_isporg,b.orgname,
s1.value AS limittime,s2.value AS simuse,s3.value AS limitusageperiod,
s4.value AS limittraffic,s5.value AS limitdownloadrate,s6.value AS limitdaysofvalidity,
s7.value AS limituploadrate,s8.value AS homepage,s9.value AS idletimeout
FROM acc_usagedefinition a
LEFT JOIN acc_isporg b ON (a.id_isporg = b.id)
LEFT JOIN radgroupcheck s1 ON (a.id=s1.groupname::integer AND s1.attribute LIKE ?)
LEFT JOIN radgroupcheck s2 ON (a.id=s2.groupname::integer AND s2.attribute LIKE ?)
LEFT JOIN radgroupcheck s3 ON (a.id=s3.groupname::integer AND s3.attribute LIKE ?)
LEFT JOIN radgroupreply s4 ON (a.id=s4.groupname::integer AND s4.attribute LIKE ?)
LEFT JOIN radgroupreply s5 ON (a.id=s5.groupname::integer AND s5.attribute LIKE ?)
LEFT JOIN radgroupreply s6 ON (a.id=s6.groupname::integer AND s6.attribute LIKE ?)
LEFT JOIN radgroupreply s7 ON (a.id=s7.groupname::integer AND s7.attribute LIKE ?)
LEFT JOIN radgroupreply s8 ON (a.id=s8.groupname::integer AND s8.attribute LIKE ?)
LEFT JOIN radgroupreply s9 ON (a.id=s9.groupname::integer AND s9.attribute LIKE ?)
WHERE a.id = ?;

!del_radgroupreply
DELETE FROM radgroupreply
WHERE groupname = ?;

!del_radgroupcheck
DELETE FROM radgroupcheck
WHERE groupname = ?;

!upd_def
UPDATE acc_usagedefinition 
SET definitionname=?,
WHERE id = ?;

