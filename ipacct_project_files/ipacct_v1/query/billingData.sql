!sel_postp
SELECT COUNT(a.id) AS sessions,ROUND(SUM(a.timespent)/60/c.billingunit) AS buspent,
b.id_accseries AS serid,a.id_usagedefinition AS defid,
c.billingunit,c.pricebillingunit,c.measureunit,c.priceonstart
FROM  acc_postpaccountlog a, acc_postpaccount b,acc_usagedefinition c
WHERE a.id_usagedefinition = c.id
AND a.id_postpaccount = b.id
AND a.srvstarttime >= ?
AND a.srvstarttime <= ?
AND a.srvstoptime > 0
AND b.id_isporg = ?
AND c.pricebillingunit > 0
AND c.measureunit LIKE 'min'
GROUP BY a.id_usagedefinition,b.id_accseries,c.billingunit,c.pricebillingunit,c.measureunit,c.priceonstart
UNION
SELECT COUNT(a.id) AS sessions,ROUND(SUM(a.trafficspent)/1024/c.billingunit) AS buspent,
b.id_accseries AS serid,a.id_usagedefinition AS defid,
c.billingunit,c.pricebillingunit,c.measureunit,c.priceonstart
FROM  acc_postpaccountlog a, acc_postpaccount b,acc_usagedefinition c
WHERE a.id_usagedefinition = c.id
AND a.id_postpaccount = b.id
AND a.srvstarttime >= ?
AND a.srvstarttime <= ?
AND a.srvstoptime > 0
AND b.id_isporg = ?
AND c.pricebillingunit > 0
AND c.measureunit LIKE 'kb'
GROUP BY a.id_usagedefinition,b.id_accseries,c.billingunit,c.pricebillingunit,c.measureunit,c.priceonstart;

!sel_prep_sale
SELECT COUNT(a.id) AS sessions,COUNT(a.id) AS buspent,
a.id_accseries AS serid,b.id_usagedefinition AS defid,c.pricebillingunit,c.measureunit
FROM acc_prepaccount a,acc_accseries b,acc_usagedefinition c
WHERE a.id_accseries = b.id
AND b.id_usagedefinition = c.id
AND c.pricebillingunit > 0
AND a.datesale >= ?
AND a.datesale <= ?
AND a.datestorn IS NULL
AND a.id_isporg = ?
GROUP BY a.id_accseries,b.id_usagedefinition,c.pricebillingunit,c.measureunit;

!sel_prep_log
SELECT COUNT(a.username) AS buspent,SUM(a.nrsession) AS sessions,
a.id_accseries AS serid,b.id_usagedefinition AS defid,
c.pricebillingunit,c.measureunit
FROM acc_prepaccount a,acc_accseries b,acc_usagedefinition c
WHERE a.id_accseries = b.id
AND b.id_usagedefinition = c.id
AND c.pricebillingunit > 0
AND a.datefirstuse IS NOT NULL
AND a.datefirstuse >= ?
AND a.datefirstuse <= ?
AND a.id_isporg = ?
GROUP BY a.id_accseries,b.id_usagedefinition,c.pricebillingunit,c.measureunit;
