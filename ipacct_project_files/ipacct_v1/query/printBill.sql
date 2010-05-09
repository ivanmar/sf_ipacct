!sel_s_bill
SELECT b.id_isporg,b.id_ispsuborg,a.s_bill,b.username,a.srvstarttime,a.srvstoptime,
c.username AS systemuser,
ROUND(SUM(a.timespent)/60/d.billingunit) AS buspent,
d.billingunit,d.pricebillingunit,d.measureunit,d.priceonstart
FROM acc_postpaccountlog a,acc_postpaccount b,acc_systemuser c,acc_usagedefinition d
WHERE a.id_postpaccount=b.id
AND a.id_systemuser=c.id
AND a.id_usagedefinition=d.id
AND d.pricebillingunit > 0
AND d.measureunit='min'
AND a.s_bill = ?
GROUP BY b.id_isporg,b.id_ispsuborg,a.s_bill,b.username,a.srvstarttime,a.srvstoptime,
c.username,d.billingunit,d.pricebillingunit,d.measureunit,d.priceonstart
UNION
SELECT b.id_isporg,b.id_ispsuborg,a.s_bill,b.username,a.srvstarttime,a.srvstoptime,
c.username AS systemuser,
ROUND(SUM(a.trafficspent)/1024/d.billingunit) AS buspent,
d.billingunit,d.pricebillingunit,d.measureunit,d.priceonstart
FROM acc_postpaccountlog a,acc_postpaccount b,acc_systemuser c,acc_usagedefinition d
WHERE a.id_postpaccount=b.id
AND a.id_systemuser=c.id
AND a.id_usagedefinition=d.id
AND d.pricebillingunit > 0
AND d.measureunit='kb'
AND a.s_bill = ?
GROUP BY b.id_isporg,b.id_ispsuborg,a.s_bill,b.username,a.srvstarttime,a.srvstoptime,
c.username,d.billingunit,d.pricebillingunit,d.measureunit,d.priceonstart
ORDER BY 1
