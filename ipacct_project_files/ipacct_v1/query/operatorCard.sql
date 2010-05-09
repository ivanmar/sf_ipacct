!sel_accounts
SELECT COUNT(a.id) AS nraccount,a.id_accseries,c.definitionname,c.pricebillingunit
FROM acc_prepaccount a, acc_accseries b,acc_usagedefinition c
WHERE a.id_accseries=b.id 
AND b.id_usagedefinition=c.id
AND a.id_isporg=?
AND a.id_ispsuborg=?
AND a.datesale IS NULL
AND a.datestorn IS NULL
AND a.ind_ondemand LIKE 1
GROUP BY a.id_accseries,c.pricebillingunit,c.definitionname;

!saled_cards
SELECT a.id_accseries,a.datesale,a.s_card,a.username AS carduser,
c.definitionname,c.pricebillingunit,d.username
FROM acc_prepaccount a,acc_accseries b,acc_usagedefinition c,acc_systemuser d
WHERE a.id_accseries=b.id
AND b.id_usagedefinition=c.id
AND a.id_systemuser=d.id
AND a.id_isporg=?
AND a.id_ispsuborg=?
AND a.datesale IS NOT NULL;

!sale_get_user
SELECT username FROM acc_prepaccount
WHERE id_accseries=?
AND datesale IS NULL
AND datestorn IS NULL
AND ind_ondemand LIKE 1
LIMIT 1;

!sale_upd_preplog
UPDATE acc_prepaccount
SET datesale = NOW(),
id_systemuser=?
WHERE username LIKE ?;

!check_card
SELECT username FROM acc_prepaccount
WHERE id_isporg=?
AND s_card LIKE ?
AND datesale IS NOT NULL;

!storn_del_radcheck
DELETE FROM radcheck
WHERE username LIKE ?;

!storn_del_radreply
DELETE FROM radreply
WHERE username LIKE ?;

!storn_upd_preplog
UPDATE acc_prepaccount
SET datesale = NULL,
datestorn=NOW()
WHERE username LIKE ?;
