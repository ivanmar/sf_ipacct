!sel_s_bill
SELECT a.s_bill,b.username,a.srvstoptime,c.username AS systemuser,
ROUND(SUM(a.timespent)/60/e.billingunit) AS buspent,
e.billingunit,e.pricebillingunit,e.measureunit,e.priceonstart
FROM acc_postpaccountlog a,acc_postpaccount b,
acc_systemuser c,acc_accseries d,acc_usagedefinition e
WHERE a.id_postpaccount=b.id
AND a.id_systemuser=c.id
AND b.id_accseries=d.id
AND d.id_usagedefinition = e.id
AND e.pricebillingunit > 0
AND e.measureunit LIKE 'min'
AND a.srvstoptime IS NOT NULL
AND b.username LIKE ?
GROUP BY a.s_bill,b.username,a.srvstoptime,c.username,
e.billingunit,e.pricebillingunit,e.measureunit,e.priceonstart
UNION
SELECT a.s_bill,b.username,a.srvstoptime,c.username AS systemuser,
ROUND(SUM(a.trafficspent)/1024/e.billingunit) AS buspent,
e.billingunit,e.pricebillingunit,e.measureunit,e.priceonstart
FROM acc_postpaccountlog a,acc_postpaccount b,
acc_systemuser c,acc_accseries d,acc_usagedefinition e
WHERE a.id_postpaccount=b.id
AND a.id_systemuser=c.id
AND b.id_accseries=d.id
AND d.id_usagedefinition = e.id
AND e.pricebillingunit > 0
AND e.measureunit LIKE 'kb'
AND a.srvstoptime IS NOT NULL
AND b.username LIKE ?
GROUP BY a.s_bill,b.username,a.srvstoptime,c.username,
e.billingunit,e.pricebillingunit,e.measureunit,e.priceonstart
ORDER BY 1 DESC
