!sel_nas
SELECT a.calledstationid AS mac,COUNT(a.username) AS users,
b.pacc_nasipaddress,b.nasname,b.shortname,b.pacc_adminport,c.suborgname
FROM radacct a,nas b,acc_ispsuborg c
WHERE b.pacc_nasipaddress = a.nasipaddress
AND c.id=b.pacc_id_ispsuborg
AND b.pacc_id_isporg = ?
AND a.acctstoptime IS NULL
GROUP BY 1,3,4,5,6,7
UNION
SELECT 'no-mac' AS mac,0 AS users,
b.pacc_nasipaddress,b.nasname,b.shortname,b.pacc_adminport,c.suborgname
FROM nas b,acc_ispsuborg c
WHERE b.pacc_id_isporg = ?
AND c.id=b.pacc_id_ispsuborg
AND b.pacc_nasipaddress NOT IN
(SELECT nasipaddress FROM radacct WHERE acctstoptime IS NULL)
GROUP BY 1,3,4,5,6,7
UNION
SELECT b.pacc_macaddress AS mac,COUNT(a.username) AS users,
b.pacc_nasipaddress,b.nasname,b.shortname,b.pacc_adminport,c.suborgname
FROM radacct a,nas b,acc_ispsuborg c
WHERE b.pacc_macaddress = a.calledstationid
AND c.id=b.pacc_id_ispsuborg
AND b.pacc_id_isporg = ?
AND b.pacc_macaddress IS NOT NULL
AND a.acctstoptime IS NULL
GROUP BY 1,3,4,5,6,7
ORDER BY 5;