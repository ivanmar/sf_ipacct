!get_isp
SELECT id,orgname
FROM acc_isporg
ORDER BY id;

!get_orginfo
SELECT orgname,address,zipcode,city
FROM acc_isporg
WHERE id = ?;

!get_suborginfo
SELECT suborgname,address,city,phone
FROM acc_ispsuborg
WHERE id_isporg = ?
AND id = ?; 

!get_definfo
SELECT a.id,a.definitionname,a.acctype,a.pricebillingunit,a.id_isporg,
a.measureunit,a.billingunit,a.priceonstart,b.orgname,
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
WHERE a.id = ?
LIMIT 1;

!get_defs
SELECT id,definitionname
FROM acc_usagedefinition
WHERE acctype LIKE ?
AND id_isporg = ?;

