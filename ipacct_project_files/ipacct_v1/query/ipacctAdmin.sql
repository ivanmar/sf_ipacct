!del_stale
DELETE FROM radacct 
WHERE acctstoptime IS NULL 
AND acctstarttime <= ?;

!del_radacct
DELETE FROM radacct
WHERE acctstoptime < ?;

!clean_sess
UPDATE radacct SET acctterminatecause='Session-Timeout' 
WHERE username IN (SELECT a.username FROM acc_prepaccount a, acc_accseries b, radgroupreply c, radacct d
WHERE a.datelastuse IS NULL
AND a.id_accseries = b.id
AND b.id_usagedefinition = c.groupname::integer
AND c.attribute LIKE 'Session-Timeout'
AND a.username LIKE d.username
AND d.acctsessiontime::integer > (c.value::integer - 400)
GROUP BY a.username);

!indexdb
REINDEX DATABASE ipacct_radius;
