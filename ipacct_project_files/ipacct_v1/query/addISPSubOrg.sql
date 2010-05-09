!add_ispsuborg
INSERT INTO acc_ispsuborg
(suborgname,id_isporg,address,city,zipcode,phone,email,contactname,radlocation)
VALUES (?,?,?,?,?,?,?,?,?);

!list_ispsuborg
SELECT a.id,a.suborgname,a.address,a.city,a.phone,a.contactname,a.email,b.orgname
FROM acc_ispsuborg a, acc_isporg b
WHERE a.id_isporg = b.id
AND a.id_isporg = ?;

!check_ispsuborg
SELECT id
FROM acc_postpaccount
WHERE id_ispsuborg = ?;

!check_ispsuborg_user
SELECT id
FROM acc_systemuser
WHERE id_ispsuborg = ?;

!del_ispsuborg
DELETE FROM acc_ispsuborg
WHERE id = ?;
