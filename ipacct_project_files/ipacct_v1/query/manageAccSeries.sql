!get_definfo
SELECT a.id,a.definitionname,a.acctype,a.pricebillingunit,a.id_isporg,
a.measureunit,a.billingunit,a.priceonstart,b.orgname,c.crdate,
s1.value AS limittime,s2.value AS simuse,s3.value AS limitusageperiod,
s4.value AS limittraffic,s5.value AS limitdownloadrate,s6.value AS limitdaysofvalidity
FROM acc_usagedefinition a
LEFT JOIN acc_isporg b ON (a.id_isporg = b.id)
LEFT JOIN acc_accseries c ON (a.id = c.id_usagedefinition)
LEFT JOIN radgroupcheck s1 ON (a.id=s1.groupname::integer AND s1.attribute LIKE ?)
LEFT JOIN radgroupcheck s2 ON (a.id=s2.groupname::integer AND s2.attribute LIKE ?)
LEFT JOIN radgroupcheck s3 ON (a.id=s3.groupname::integer AND s3.attribute LIKE ?)
LEFT JOIN radgroupreply s4 ON (a.id=s4.groupname::integer AND s4.attribute LIKE ?)
LEFT JOIN radgroupreply s5 ON (a.id=s5.groupname::integer AND s5.attribute LIKE ?)
LEFT JOIN radgroupreply s6 ON (a.id=s6.groupname::integer AND s6.attribute LIKE ?)
WHERE c.id = ?
LIMIT 1;

!sel_prep_acc_info
SELECT a.username,a.s_card,a.dateissue,a.datesale,a.datestorn,a.ind_used,a.datelastuse AS lastlogin,a.nrsession AS sessions,
a.timespent AS sessiontime, a.trafficspent AS traffic,b.value AS password
FROM acc_prepaccount a
LEFT OUTER JOIN radcheck b ON (a.username=b.username AND b.attribute LIKE 'User-Password')
WHERE ind_used LIKE '1'
AND id_accseries = ?
UNION
SELECT a.username,a.s_card,a.dateissue,a.datesale,a.datestorn,a.ind_used,MAX(b.acctstarttime) AS lastlogin,COUNT(b.radacctid) AS sessions,
SUM(b.acctsessiontime) AS sessiontime,
SUM(b.acctinputoctets+b.acctoutputoctets) AS traffic,c.value AS password
FROM acc_prepaccount a 
LEFT OUTER JOIN radacct b ON (a.username=b.username)
LEFT OUTER JOIN radcheck c ON (a.username=c.username AND c.attribute LIKE 'User-Password')
WHERE a.ind_used IS NULL 
AND a.id_accseries=?
GROUP BY a.username,a.s_card,a.dateissue,a.datesale,a.datestorn,a.ind_used,c.value;

!sel_postp_acc_info
SELECT COUNT(a.id) AS logsessions,b.username,
MAX(a.srvstarttime) AS lastlogin,SUM(a.timespent) AS sessiontime,
SUM(a.trafficspent) AS traffic, c.value AS password
FROM acc_postpaccountlog a 
RIGHT JOIN acc_postpaccount b ON (a.id_postpaccount=b.id)
LEFT OUTER JOIN radcheck c ON (b.username=c.username AND c.attribute LIKE 'User-Password')
WHERE b.id_accseries=?
GROUP BY b.username,c.value;

!sel_subs_acc_info
SELECT COUNT(a.radacctid) AS logsessions,b.username,
MAX(a.acctstarttime) AS lastlogin,SUM(a.acctsessiontime) AS sessiontime,
SUM(a.acctinputoctets+a.acctoutputoctets) AS traffic,
c.value AS password
FROM radacct a RIGHT JOIN acc_subscriberinfo b ON (a.username=b.username) LEFT JOIN radcheck c ON (b.username=c.username AND attribute LIKE 'User-Password')
WHERE b.id_accseries=?
GROUP BY b.username,c.value;

!check_preplog
SELECT id
FROM acc_prepaccount
WHERE username = ?
AND datesale IS NOT NULL;

!check_prepacc_storn
SELECT datestorn
FROM acc_prepaccount
WHERE username = ?;

!check_radacct
SELECT radacctid
FROM radacct
WHERE username = ?;

!del_acc_radcheck
DELETE FROM radcheck
WHERE username=?;

!del_acc_radacct
DELETE FROM radacct
WHERE username=?;

!del_acc_radreply
DELETE FROM radreply
WHERE username=?;

!del_acc_prepacc
DELETE FROM acc_prepaccount
WHERE username=?;

!upd_prepacc_storn
UPDATE acc_prepaccount
SET datestorn=NOW(),
datesale=NULL
WHERE username=?;

!upd_prepacc_sold
UPDATE acc_prepaccount
SET datestorn=NULL,
datesale=NOW()
WHERE username=?;

!check_postplog
SELECT id
FROM acc_postpaccountlog
WHERE id_postpaccount IN (SELECT id
FROM acc_postpaccount
WHERE username = ?);

!upd_def_ser
UPDATE acc_accseries
SET id_usagedefinition=?
WHERE id = ?;

!del_acc_postpacclog
DELETE FROM acc_postpaccountlog
WHERE id_postpaccount IN (SELECT id
FROM acc_postpaccount
WHERE username = ?);

!del_acc_postpacc
DELETE FROM acc_postpaccount
WHERE username=?;

!upd_postp_nracc
UPDATE acc_accseries
SET nraccount=(SELECT COUNT(username) FROM acc_postpaccount
WHERE id_accseries = ?)
WHERE id = ?;

!get_userpass
SELECT a.username,b.value AS password,a.s_card
FROM acc_prepaccount a,radcheck b
WHERE a.id_accseries=pacc_id_accseries
AND a.username=b.username
AND b.attribute LIKE 'User-Password'
AND a.id_accseries=?;


