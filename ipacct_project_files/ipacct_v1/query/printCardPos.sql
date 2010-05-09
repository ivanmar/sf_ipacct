!get_cardinfo
SELECT a.id_accseries,a.id_isporg,a.username,d.value AS password,
c.limittraffic,c.limittime,c.pricebillingunit,e.orgname,f.suborgname
FROM acc_prepaccount a, acc_accseries b,acc_usagedefinition c,radcheck d,acc_isporg e,acc_ispsuborg f
WHERE a.id_accseries=b.id
AND b.id_usagedefinition=c.id
AND a.id_isporg=e.id
AND a.id_ispsuborg=f.id
AND d.attribute='User-Password'
AND a.username=d.username
AND a.s_card LIKE ?;
