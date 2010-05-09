!sel_check
SELECT a.id,a.ind_active,a.id_accseries,b.id_usagedefinition
FROM acc_postpaccount a,acc_accseries b,acc_usagedefinition c
WHERE a.id_accseries=b.id
AND b.id_usagedefinition=c.id
AND a.id_isporg=?
AND a.id_ispsuborg=?
AND a.username LIKE ?;

!ins_postplog
INSERT INTO acc_postpaccountlog
(id_postpaccount,srvstarttime,id_systemuser,id_usagedefinition)
VALUES(?,NOW(),?,?);

!upd_activation
UPDATE acc_postpaccount
SET ind_active = ?
WHERE username LIKE ?;

!chk_active
SELECT ind_active 
FROM  acc_postpaccount
WHERE username LIKE ?;

!upd_pass
UPDATE radcheck
SET value=?
WHERE username LIKE ?
AND attribute LIKE 'User-Password'
AND pacc_id_accseries=?;

!upd_postplog
UPDATE acc_postpaccountlog
SET id_systemuser=?,
s_bill=?,
srvstoptime=NOW(),
timespent= (SELECT SUM(acctsessiontime) FROM radacct WHERE username LIKE ?),
trafficspent=(SELECT SUM(acctinputoctets+acctoutputoctets) FROM radacct WHERE username LIKE ?)
WHERE srvstoptime IS NULL
AND id_postpaccount=?;


!sel_billdata
SELECT a.username,
ROUND(SUM(b.acctsessiontime)/60/d.billingunit) AS buspent,
d.billingunit,d.pricebillingunit,d.measureunit,d.priceonstart
FROM acc_postpaccount a 
LEFT JOIN radacct b ON (a.username LIKE b.username),acc_accseries c,acc_usagedefinition d
WHERE a.id_accseries=c.id
AND c.id_usagedefinition = d.id
AND a.ind_active LIKE '1'
AND a.id_isporg = ?
AND a.id_ispsuborg = ?
AND d.pricebillingunit > 0
AND d.measureunit LIKE 'min'
GROUP BY a.username,d.billingunit, d.pricebillingunit, d.measureunit, d.priceonstart
UNION
SELECT a.username,
ROUND(SUM(b.acctinputoctets+b.acctoutputoctets)/1024/d.billingunit) AS buspent,
d.billingunit,d.pricebillingunit,d.measureunit,d.priceonstart
FROM acc_postpaccount a 
LEFT JOIN radacct b ON (a.username LIKE b.username),acc_accseries c,acc_usagedefinition d
WHERE a.id_accseries=c.id
AND c.id_usagedefinition = d.id
AND a.ind_active LIKE '1'
AND a.id_isporg = ?
AND a.id_ispsuborg = ?
AND d.pricebillingunit > 0
AND d.measureunit LIKE 'kb'
GROUP BY a.username,d.billingunit, d.pricebillingunit, d.measureunit, d.priceonstart;

