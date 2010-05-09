!add_isp
INSERT INTO acc_isporg
(orgname,address,city,zipcode,phone,billinginfo,contactname,email_report,email_nasadmin,pst_commission,radlocation)
VALUES (?,?,?,?,?,?,?,?,?,?,?);

!add_ispsuborg
INSERT INTO acc_ispsuborg
(suborgname, id_isporg,radlocation)
VALUES ('default',?,?);

!list_isp
SELECT * FROM acc_isporg;

!check_isp_user
SELECT id
FROM acc_systemuser
WHERE id_isporg = ?;

!check_isp_def
SELECT id
FROM acc_usagedefinition
WHERE id_isporg = ?;

!check_ispsuborg
SELECT id
FROM acc_ispsuborg
WHERE id_isporg = ?;

!del_isp
DELETE FROM acc_isporg
WHERE id = ?;
!sel_isporg
SELECT orgname,address,city,zipcode,phone,billinginfo,contactname,email_report,email_nasadmin,pst_commission
FROM acc_isporg
WHERE id = ?;

!upd_isporg
UPDATE acc_isporg
SET orgname=?,
address=?,
city=?,
zipcode=?,
phone=?,
billinginfo=?,
contactname=?,
email_report=?,
email_nasadmin=?,
pst_commission=?
WHERE id = ?;
