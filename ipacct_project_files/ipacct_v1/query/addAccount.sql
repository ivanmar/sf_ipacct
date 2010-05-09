!sel_def_limit
SELECT limitdownloadrate,limituploadrate,limittraffic,limittime,limitdaysofvalidity,limitusageperiod,simuse,homepage,updateinterval,idletimeout
FROM acc_usagedefinition
WHERE id = ?;

!ins_accseries
INSERT INTO acc_accseries (id_usagedefinition,id_isporg,id_ispsuborg,id_systemuser,crdate,nraccount,acctype,pst_commission)
VALUES (?,?,?,?,NOW(),?,?,(SELECT pst_commission FROM acc_isporg WHERE id=?));

!ins_subscriber
INSERT INTO acc_subscriberinfo (username, name, id_isporg, address, city, phone, email,id_accseries)
VALUES (?,?,?,?,?,?,?,?);

!sel_ispsuborg
SELECT id,suborgname
FROM acc_ispsuborg
WHERE id_isporg = ?
ORDER BY id;

!sel_radloc_isp
SELECT radlocation FROM acc_isporg WHERE id=?;

!sel_radloc_sub
SELECT radlocation FROM acc_ispsuborg WHERE id_isporg=?;

!ins_postpacc
INSERT INTO acc_postpaccount
(username,id_isporg,id_ispsuborg,id_accseries)
VALUES (?,?,?,?);

!ins_prepacc
INSERT INTO acc_prepaccount
(username,id_isporg,id_ispsuborg,id_accseries,s_card,ind_ondemand,dateissue)
VALUES (?,?,?,?,?,?,NOW());

!userpass
INSERT INTO radcheck (username, attribute, op, value, pacc_id_accseries)
VALUES (?,'User-Password',':=',?,?);

!radlocation
INSERT INTO radcheck (username, attribute, op, value)
VALUES (?,'WISPr-Location-Id','==',?);

!usergroup
INSERT INTO radusergroup (username, groupname, priority)
VALUES (?,?,1);
