!sel_prep_sale
SELECT d.suborgname,
date_trunc(?,a.datesale) AS period,
SUM(c.pricebillingunit) AS cash
FROM acc_prepaccount a,acc_accseries b,acc_usagedefinition c,acc_ispsuborg d
WHERE a.id_accseries = b.id
AND b.id_usagedefinition = c.id
AND a.id_ispsuborg = d.id
AND c.pricebillingunit > 0
AND a.datestorn IS NULL
AND a.datesale IS NOT NULL
AND a.id_isporg = ?
AND a.datesale >= ?
AND a.datesale <= ?
GROUP BY d.suborgname,period
ORDER BY period;

!sel_prep_log
SELECT d.suborgname,
date_trunc(?,a.datefirstuse) AS period,
SUM(c.pricebillingunit) AS cash
FROM acc_prepaccount a,acc_accseries b,acc_usagedefinition c,acc_ispsuborg d
WHERE a.id_accseries = b.id
AND b.id_usagedefinition = c.id
AND a.id_ispsuborg = d.id
AND c.pricebillingunit > 0
AND a.datefirstuse IS NOT NULL
AND a.id_isporg = ?
AND a.datefirstuse >= ?
AND a.datefirstuse <= ?
GROUP BY d.suborgname,period
ORDER BY period;

!sel_postp_tm
SELECT d.suborgname,
date_trunc(?,a.srvstoptime) AS period,
SUM(a.timespent/60/c.billingunit*c.pricebillingunit) AS cash
FROM  acc_postpaccountlog a, acc_postpaccount b,acc_usagedefinition c,acc_ispsuborg d
WHERE a.id_usagedefinition = c.id
AND a.id_postpaccount = b.id
AND b.id_isporg = ?
AND a.srvstarttime >= ?
AND a.srvstarttime <= ?
AND a.srvstoptime > 0
AND b.id_ispsuborg = d.id
AND c.pricebillingunit > 0
AND c.measureunit LIKE 'min'
GROUP BY d.suborgname,period
ORDER BY period;

!sel_postp_tr
SELECT d.suborgname,
date_trunc(?,a.srvstoptime) AS period,
SUM(a.trafficspent/1024/c.billingunit*c.pricebillingunit) AS cash
FROM  acc_postpaccountlog a, acc_postpaccount b,acc_usagedefinition c,acc_ispsuborg d
WHERE a.id_usagedefinition = c.id
AND a.id_postpaccount = b.id
AND b.id_isporg = ?
AND a.srvstarttime >= ?
AND a.srvstarttime <= ?
AND a.srvstoptime > 0
AND b.id_ispsuborg = d.id
AND c.pricebillingunit > 0
AND c.measureunit LIKE 'kb'
GROUP BY d.suborgname,period
ORDER BY period;
