CREATE TABLE acc_accseries (id INT, id_usagedefinition INT NOT NULL, id_isporg INT NOT NULL, id_systemuser INT NOT NULL, crdate TIMESTAMP NOT NULL, nraccount NUMERIC(18,2) NOT NULL, acctype TEXT NOT NULL, pst_commission NUMERIC(18,2) DEFAULT 0, id_ispsuborg INT, PRIMARY KEY(id));
CREATE TABLE acc_isporg (id INT, name TEXT NOT NULL, address TEXT, city TEXT, zipcode TEXT, phone TEXT, billinginfo TEXT, contactname TEXT, email_report TEXT, email_nasadmin TEXT, pst_commission NUMERIC(18,2) DEFAULT 0, radlocation TEXT, PRIMARY KEY(id));
CREATE TABLE acc_ispsuborg (id INT, name TEXT NOT NULL, id_isporg INT NOT NULL, address TEXT, city TEXT, zipcode TEXT, phone TEXT, email TEXT, contactname TEXT, radlocation TEXT, PRIMARY KEY(id));
CREATE TABLE acc_postpaccount (id INT, username TEXT NOT NULL, id_isporg INT NOT NULL, id_ispsuborg INT NOT NULL, id_accseries INT NOT NULL, ind_active CHAR(255) DEFAULT '0', PRIMARY KEY(id));
CREATE TABLE acc_postpaccountlog (id INT, id_postpaccount INT NOT NULL, srvstarttime TIMESTAMP NOT NULL, srvstoptime TIMESTAMP, timespent BIGINT DEFAULT 0, trafficspent BIGINT DEFAULT 0, id_systemuser INT NOT NULL, s_bill TEXT, accountinfo TEXT, id_usagedefinition INT NOT NULL, PRIMARY KEY(id));
CREATE TABLE acc_prepaccount (id INT, username TEXT NOT NULL, id_accseries INT NOT NULL, id_isporg INT NOT NULL, id_ispsuborg INT, id_systemuser INT, s_card TEXT NOT NULL, dateissue TIMESTAMP, datesale TIMESTAMP, datestorn TIMESTAMP, ind_ondemand CHAR(255), datefirstuse TIMESTAMP, datelastuse TIMESTAMP, trafficspent BIGINT, nrsession NUMERIC(18,2), ind_used CHAR(255), timespent BIGINT, PRIMARY KEY(id));
CREATE TABLE acc_subscriberinfo (id INT, username TEXT NOT NULL, name TEXT, id_isporg INT NOT NULL, address TEXT, city TEXT, phone TEXT, email TEXT, id_accseries INT NOT NULL, PRIMARY KEY(id));
CREATE TABLE acc_systemuser (id INT, username TEXT NOT NULL, pass TEXT NOT NULL, acctype TEXT NOT NULL, id_isporg INT NOT NULL, id_ispsuborg INT, name TEXT, email TEXT, phone TEXT, mobile TEXT, lang CHAR(255), PRIMARY KEY(id));
CREATE TABLE acc_usagedefinition (id INT, id_isporg INT DEFAULT 0 NOT NULL, definitionname TEXT NOT NULL, acctype TEXT NOT NULL, measureunit TEXT, billingunit NUMERIC(18,2), pricebillingunit NUMERIC(18,2) DEFAULT 0, priceonstart NUMERIC(18,2) DEFAULT 0, PRIMARY KEY(id));
CREATE TABLE nas (id INT, nasname TEXT NOT NULL, shortname TEXT NOT NULL, type TEXT DEFAULT 'other' NOT NULL, ports INT, secret TEXT NOT NULL, community TEXT, description TEXT, id_isporg INT NOT NULL, pacc_nasipaddress INET, pacc_conn_user TEXT, pacc_conn_pass TEXT, pacc_admin_user TEXT, pacc_admin_pass TEXT, id_ispsuborg INT, pacc_macaddress TEXT, pacc_ssid TEXT, pacc_radlocation TEXT, pacc_adminport INT, PRIMARY KEY(id));
CREATE TABLE radacct (id BIGINT, acctsessionid TEXT NOT NULL, acctuniqueid TEXT NOT NULL, username TEXT, groupname TEXT, realm TEXT, nasipaddress INET NOT NULL, nasportid TEXT, nasporttype TEXT, acctstarttime TIMESTAMP, acctstoptime TIMESTAMP, acctsessiontime BIGINT, acctauthentic TEXT, connectinfo_start TEXT, connectinfo_stop TEXT, acctinputoctets BIGINT DEFAULT 0, acctoutputoctets BIGINT DEFAULT 0, calledstationid TEXT, callingstationid TEXT, acctterminatecause TEXT, servicetype TEXT, framedprotocol TEXT, framedipaddress INET, acctstartdelay BIGINT, acctstopdelay BIGINT, xascendsessionsvrkey TEXT, PRIMARY KEY(id));
CREATE TABLE radcheck (id INT, username TEXT DEFAULT '' NOT NULL, attr TEXT DEFAULT '' NOT NULL, op TEXT DEFAULT '==' NOT NULL, value TEXT DEFAULT '' NOT NULL, id_accseries INT, PRIMARY KEY(id));
CREATE TABLE radgroupcheck (id INT, groupname TEXT DEFAULT '' NOT NULL, attr TEXT DEFAULT '' NOT NULL, op TEXT DEFAULT '==' NOT NULL, value TEXT DEFAULT '' NOT NULL, PRIMARY KEY(id));
CREATE TABLE radgroupreply (id INT, groupname TEXT DEFAULT '' NOT NULL, attr TEXT DEFAULT '' NOT NULL, op TEXT DEFAULT '=' NOT NULL, value TEXT DEFAULT '' NOT NULL, PRIMARY KEY(id));
CREATE TABLE radpostauth (id BIGINT, username TEXT NOT NULL, pass TEXT, reply TEXT, calledstationid TEXT, callingstationid TEXT, authdate TIMESTAMP NOT NULL, PRIMARY KEY(id));
CREATE TABLE radreply (id INT, username TEXT DEFAULT '' NOT NULL, attr TEXT DEFAULT '' NOT NULL, op TEXT DEFAULT '=' NOT NULL, value TEXT DEFAULT '' NOT NULL, PRIMARY KEY(id));
CREATE TABLE radusergroup (id BIGSERIAL, username TEXT DEFAULT '' NOT NULL, groupname TEXT DEFAULT '' NOT NULL, priority INT DEFAULT 0 NOT NULL, PRIMARY KEY(id));
CREATE SEQUENCE acc_accseries_id_seq INCREMENT 1 START 1;
CREATE SEQUENCE acc_isporg_id_seq INCREMENT 1 START 1;
CREATE SEQUENCE acc_ispsuborg_id_seq INCREMENT 1 START 1;
CREATE SEQUENCE acc_postpaccount_id_seq INCREMENT 1 START 1;
CREATE SEQUENCE acc_postpaccountlog_id_seq INCREMENT 1 START 1;
CREATE SEQUENCE acc_prepaccount_id_seq INCREMENT 1 START 1;
CREATE SEQUENCE acc_subscriberinfo_id_seq INCREMENT 1 START 1;
CREATE SEQUENCE acc_systemuser_id_seq INCREMENT 1 START 1;
CREATE SEQUENCE acc_usagedefinition_id_seq INCREMENT 1 START 1;
CREATE SEQUENCE nas_id_seq INCREMENT 1 START 1;
CREATE SEQUENCE radacct_radacctid_seq INCREMENT 1 START 1;
CREATE SEQUENCE radcheck_id_seq INCREMENT 1 START 1;
CREATE SEQUENCE radgroupcheck_id_seq INCREMENT 1 START 1;
CREATE SEQUENCE radgroupreply_id_seq INCREMENT 1 START 1;
CREATE SEQUENCE radpostauth_id_seq INCREMENT 1 START 1;
CREATE SEQUENCE radreply_id_seq INCREMENT 1 START 1;
ALTER TABLE acc_accseries ADD CONSTRAINT acc_accseries_id_usagedefinition_acc_usagedefinition_id FOREIGN KEY (id_usagedefinition) REFERENCES acc_usagedefinition(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_accseries ADD CONSTRAINT acc_accseries_id_systemuser_acc_systemuser_id FOREIGN KEY (id_systemuser) REFERENCES acc_systemuser(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_accseries ADD CONSTRAINT acc_accseries_id_ispsuborg_acc_ispsuborg_id FOREIGN KEY (id_ispsuborg) REFERENCES acc_ispsuborg(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_accseries ADD CONSTRAINT acc_accseries_id_isporg_acc_isporg_id FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_ispsuborg ADD CONSTRAINT acc_ispsuborg_id_isporg_acc_isporg_id FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_postpaccount ADD CONSTRAINT acc_postpaccount_id_ispsuborg_acc_ispsuborg_id FOREIGN KEY (id_ispsuborg) REFERENCES acc_ispsuborg(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_postpaccount ADD CONSTRAINT acc_postpaccount_id_isporg_acc_isporg_id FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_postpaccount ADD CONSTRAINT acc_postpaccount_id_accseries_acc_accseries_id FOREIGN KEY (id_accseries) REFERENCES acc_accseries(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_postpaccountlog ADD CONSTRAINT acc_postpaccountlog_id_usagedefinition_acc_usagedefinition_id FOREIGN KEY (id_usagedefinition) REFERENCES acc_usagedefinition(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_postpaccountlog ADD CONSTRAINT acc_postpaccountlog_id_systemuser_acc_systemuser_id FOREIGN KEY (id_systemuser) REFERENCES acc_systemuser(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_postpaccountlog ADD CONSTRAINT acc_postpaccountlog_id_postpaccount_acc_postpaccount_id FOREIGN KEY (id_postpaccount) REFERENCES acc_postpaccount(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_prepaccount ADD CONSTRAINT acc_prepaccount_id_systemuser_acc_systemuser_id FOREIGN KEY (id_systemuser) REFERENCES acc_systemuser(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_prepaccount ADD CONSTRAINT acc_prepaccount_id_ispsuborg_acc_ispsuborg_id FOREIGN KEY (id_ispsuborg) REFERENCES acc_ispsuborg(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_prepaccount ADD CONSTRAINT acc_prepaccount_id_isporg_acc_isporg_id FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_prepaccount ADD CONSTRAINT acc_prepaccount_id_accseries_acc_accseries_id FOREIGN KEY (id_accseries) REFERENCES acc_accseries(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_subscriberinfo ADD CONSTRAINT acc_subscriberinfo_id_accseries_acc_accseries_id FOREIGN KEY (id_accseries) REFERENCES acc_accseries(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_systemuser ADD CONSTRAINT acc_systemuser_id_ispsuborg_acc_ispsuborg_id FOREIGN KEY (id_ispsuborg) REFERENCES acc_ispsuborg(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_systemuser ADD CONSTRAINT acc_systemuser_id_isporg_acc_isporg_id FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE acc_usagedefinition ADD CONSTRAINT acc_usagedefinition_id_isporg_acc_isporg_id FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE nas ADD CONSTRAINT nas_id_ispsuborg_acc_ispsuborg_id FOREIGN KEY (id_ispsuborg) REFERENCES acc_ispsuborg(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE nas ADD CONSTRAINT nas_id_isporg_acc_isporg_id FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE radcheck ADD CONSTRAINT radcheck_id_accseries_acc_accseries_id FOREIGN KEY (id_accseries) REFERENCES acc_accseries(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
