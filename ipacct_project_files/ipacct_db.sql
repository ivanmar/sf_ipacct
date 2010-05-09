--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

--
-- Name: plpgsql; Type: PROCEDURAL LANGUAGE; Schema: -; Owner: postgres
--

CREATE PROCEDURAL LANGUAGE plpgsql;


ALTER PROCEDURAL LANGUAGE plpgsql OWNER TO postgres;

SET search_path = public, pg_catalog;

--
-- Name: process_acc(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION process_acc() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
    DECLARE
        v_datefirstuse timestamptz;
        v_datelastuse timestamptz;
        v_trafficspent int8;
        v_timespent int8;
        v_nrsession numeric(6);
        v_firstuseind int4;

    BEGIN

      IF (TG_OP = 'UPDATE' AND NEW.acctterminatecause = 'Session-Timeout') THEN
          SELECT INTO v_datefirstuse MIN(acctstarttime) FROM radacct WHERE username LIKE NEW.username;
          SELECT INTO v_datelastuse MAX(acctstoptime) FROM radacct WHERE username LIKE NEW.username;
          SELECT INTO v_trafficspent SUM(acctinputoctets + acctoutputoctets) FROM radacct WHERE username LIKE NEW.username;
          SELECT INTO v_timespent SUM(acctsessiontime) FROM radacct WHERE username LIKE NEW.username;
          SELECT INTO v_nrsession COUNT(radacctid) FROM radacct WHERE username LIKE NEW.username;

          UPDATE acc_prepaccount
          SET datefirstuse=v_datefirstuse,datelastuse=v_datelastuse,trafficspent=v_trafficspent,timespent=v_timespent,nrsession=v_nrsession,ind_used ='1'
          WHERE username LIKE NEW.username;

          DELETE FROM radcheck WHERE username LIKE NEW.username;
          DELETE FROM radreply WHERE username LIKE NEW.username;
          DELETE FROM radusergroup WHERE username LIKE NEW.username;

        END IF;
      RETURN NULL;
    END;

$$;


ALTER FUNCTION public.process_acc() OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: acc_accseries; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE acc_accseries (
    id integer NOT NULL,
    id_usagedefinition integer NOT NULL,
    id_isporg integer NOT NULL,
    id_systemuser integer NOT NULL,
    crdate timestamp(0) with time zone NOT NULL,
    nraccount numeric(6,0) NOT NULL,
    acctype character varying(64) NOT NULL,
    pst_commission numeric(3,0) DEFAULT 0,
    id_ispsuborg integer
);


ALTER TABLE public.acc_accseries OWNER TO postgres;

--
-- Name: COLUMN acc_accseries.id_systemuser; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_accseries.id_systemuser IS 'created by';


--
-- Name: COLUMN acc_accseries.acctype; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_accseries.acctype IS 'prepaid postpaid subscriber';


--
-- Name: acc_accseries_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE acc_accseries_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.acc_accseries_id_seq OWNER TO postgres;

--
-- Name: acc_accseries_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_accseries_id_seq OWNED BY acc_accseries.id;


--
-- Name: acc_accseries_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_accseries_id_seq', 1, false);


--
-- Name: acc_isporg; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE acc_isporg (
    id integer NOT NULL,
    orgname character varying(256) NOT NULL,
    address character varying(378),
    city character varying(128),
    zipcode character varying(20),
    phone character varying(64),
    billinginfo character varying(378),
    contactname character varying(64),
    email_report character varying(128),
    email_nasadmin character varying(128),
    pst_commission numeric(3,0) DEFAULT 0,
    radlocation character varying(32)
);


ALTER TABLE public.acc_isporg OWNER TO postgres;

--
-- Name: COLUMN acc_isporg.radlocation; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_isporg.radlocation IS 'top level radius location ID';


--
-- Name: acc_isporg_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE acc_isporg_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.acc_isporg_id_seq OWNER TO postgres;

--
-- Name: acc_isporg_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_isporg_id_seq OWNED BY acc_isporg.id;


--
-- Name: acc_isporg_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_isporg_id_seq', 1, false);


--
-- Name: acc_ispsuborg; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE acc_ispsuborg (
    id integer NOT NULL,
    suborgname character varying(128) NOT NULL,
    id_isporg integer NOT NULL,
    address character varying(378),
    city character varying(128),
    zipcode character varying(20),
    phone character varying(64),
    email character varying(64),
    contactname character varying(64),
    radlocation character varying(32)
);


ALTER TABLE public.acc_ispsuborg OWNER TO postgres;

--
-- Name: COLUMN acc_ispsuborg.radlocation; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_ispsuborg.radlocation IS 'sub level radius location ID';


--
-- Name: acc_ispsuborg_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE acc_ispsuborg_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.acc_ispsuborg_id_seq OWNER TO postgres;

--
-- Name: acc_ispsuborg_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_ispsuborg_id_seq OWNED BY acc_ispsuborg.id;


--
-- Name: acc_ispsuborg_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_ispsuborg_id_seq', 1, false);


--
-- Name: acc_postpaccount; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE acc_postpaccount (
    id integer NOT NULL,
    username character varying(64) NOT NULL,
    id_isporg integer NOT NULL,
    id_ispsuborg integer NOT NULL,
    id_accseries integer NOT NULL,
    ind_active character(1) DEFAULT 0
);


ALTER TABLE public.acc_postpaccount OWNER TO postgres;

--
-- Name: acc_postpaccount_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE acc_postpaccount_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.acc_postpaccount_id_seq OWNER TO postgres;

--
-- Name: acc_postpaccount_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_postpaccount_id_seq OWNED BY acc_postpaccount.id;


--
-- Name: acc_postpaccount_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_postpaccount_id_seq', 1, false);


--
-- Name: acc_postpaccountlog; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE acc_postpaccountlog (
    id integer NOT NULL,
    id_postpaccount integer NOT NULL,
    srvstarttime timestamp without time zone NOT NULL,
    srvstoptime timestamp without time zone,
    timespent bigint DEFAULT 0,
    trafficspent bigint DEFAULT 0,
    id_systemuser integer NOT NULL,
    s_bill character varying(128),
    accountinfo character varying(254),
    id_usagedefinition integer NOT NULL
);


ALTER TABLE public.acc_postpaccountlog OWNER TO postgres;

--
-- Name: COLUMN acc_postpaccountlog.timespent; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_postpaccountlog.timespent IS 'seconds';


--
-- Name: COLUMN acc_postpaccountlog.trafficspent; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_postpaccountlog.trafficspent IS 'bytes';


--
-- Name: COLUMN acc_postpaccountlog.id_usagedefinition; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_postpaccountlog.id_usagedefinition IS 'historical billing';


--
-- Name: acc_postpaccountlog_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE acc_postpaccountlog_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.acc_postpaccountlog_id_seq OWNER TO postgres;

--
-- Name: acc_postpaccountlog_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_postpaccountlog_id_seq OWNED BY acc_postpaccountlog.id;


--
-- Name: acc_postpaccountlog_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_postpaccountlog_id_seq', 1, false);


--
-- Name: acc_prepaccount; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE acc_prepaccount (
    id integer NOT NULL,
    username character varying(64) NOT NULL,
    id_accseries integer NOT NULL,
    id_isporg integer NOT NULL,
    id_ispsuborg integer,
    id_systemuser integer,
    s_card character varying(128) NOT NULL,
    dateissue timestamp with time zone,
    datesale timestamp with time zone,
    datestorn timestamp with time zone,
    ind_ondemand character(1),
    datefirstuse timestamp with time zone,
    datelastuse timestamp with time zone,
    trafficspent bigint,
    nrsession numeric(6,0),
    ind_used character(1),
    timespent bigint
);


ALTER TABLE public.acc_prepaccount OWNER TO postgres;

--
-- Name: COLUMN acc_prepaccount.id_systemuser; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_prepaccount.id_systemuser IS 'sold by';


--
-- Name: COLUMN acc_prepaccount.s_card; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_prepaccount.s_card IS 'storn id';


--
-- Name: COLUMN acc_prepaccount.timespent; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_prepaccount.timespent IS 'seconds';


--
-- Name: acc_prepaccount_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE acc_prepaccount_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.acc_prepaccount_id_seq OWNER TO postgres;

--
-- Name: acc_prepaccount_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_prepaccount_id_seq OWNED BY acc_prepaccount.id;


--
-- Name: acc_prepaccount_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_prepaccount_id_seq', 1, false);


--
-- Name: acc_subscriberinfo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE acc_subscriberinfo (
    id integer NOT NULL,
    username character varying(64) NOT NULL,
    name character varying(128),
    id_isporg integer NOT NULL,
    address character varying(256),
    city character varying(128),
    phone character varying(64),
    email character varying(64),
    id_accseries integer NOT NULL
);


ALTER TABLE public.acc_subscriberinfo OWNER TO postgres;

--
-- Name: acc_subscriberinfo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE acc_subscriberinfo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.acc_subscriberinfo_id_seq OWNER TO postgres;

--
-- Name: acc_subscriberinfo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_subscriberinfo_id_seq OWNED BY acc_subscriberinfo.id;


--
-- Name: acc_subscriberinfo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_subscriberinfo_id_seq', 1, false);


--
-- Name: acc_systemuser; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE acc_systemuser (
    id integer NOT NULL,
    username character varying(64) NOT NULL,
    pass character varying(128) NOT NULL,
    acctype character varying(20) NOT NULL,
    id_isporg integer NOT NULL,
    id_ispsuborg integer,
    name character varying(64),
    email character varying(64),
    phone character varying(32),
    mobile character varying(32),
    lang character(2)
);


ALTER TABLE public.acc_systemuser OWNER TO postgres;

--
-- Name: COLUMN acc_systemuser.acctype; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_systemuser.acctype IS 'administrator or operator';


--
-- Name: acc_systemuser_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE acc_systemuser_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.acc_systemuser_id_seq OWNER TO postgres;

--
-- Name: acc_systemuser_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_systemuser_id_seq OWNED BY acc_systemuser.id;


--
-- Name: acc_systemuser_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_systemuser_id_seq', 1, false);


--
-- Name: acc_usagedefinition; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE acc_usagedefinition (
    id integer NOT NULL,
    id_isporg integer DEFAULT 0 NOT NULL,
    definitionname character varying(256) NOT NULL,
    acctype character varying(64) NOT NULL,
    measureunit character varying(6),
    billingunit numeric(9,0),
    pricebillingunit numeric(8,2) DEFAULT 0,
    priceonstart numeric(8,2) DEFAULT 0
);


ALTER TABLE public.acc_usagedefinition OWNER TO postgres;

--
-- Name: COLUMN acc_usagedefinition.acctype; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_usagedefinition.acctype IS 'prepaid postpaid subscriber';


--
-- Name: COLUMN acc_usagedefinition.measureunit; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_usagedefinition.measureunit IS 'kb or min or card';


--
-- Name: acc_usagedefinition_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE acc_usagedefinition_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.acc_usagedefinition_id_seq OWNER TO postgres;

--
-- Name: acc_usagedefinition_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_usagedefinition_id_seq OWNED BY acc_usagedefinition.id;


--
-- Name: acc_usagedefinition_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_usagedefinition_id_seq', 1, false);


--
-- Name: nas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE nas (
    id integer NOT NULL,
    nasname character varying(128) NOT NULL,
    shortname character varying(32) NOT NULL,
    type character varying(30) DEFAULT 'other'::character varying NOT NULL,
    ports integer,
    secret character varying(60) NOT NULL,
    community character varying(50),
    description character varying(200),
    pacc_id_isporg integer NOT NULL,
    pacc_nasipaddress inet,
    pacc_conn_user character varying(32),
    pacc_conn_pass character varying(32),
    pacc_admin_user character varying(32),
    pacc_admin_pass character varying(32),
    pacc_id_ispsuborg integer,
    pacc_macaddress character varying(50),
    pacc_ssid character varying(32),
    pacc_radlocation character varying(32),
    pacc_adminport integer
);


ALTER TABLE public.nas OWNER TO postgres;

--
-- Name: COLUMN nas.shortname; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN nas.shortname IS 'shortname or dynamic dns name for virtual nases';


--
-- Name: COLUMN nas.pacc_conn_pass; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN nas.pacc_conn_pass IS 'passw za adsl';


--
-- Name: COLUMN nas.pacc_admin_pass; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN nas.pacc_admin_pass IS 'passw za hotspot';


--
-- Name: COLUMN nas.pacc_radlocation; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN nas.pacc_radlocation IS 'only used for information';


--
-- Name: nas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE nas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.nas_id_seq OWNER TO postgres;

--
-- Name: nas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE nas_id_seq OWNED BY nas.id;


--
-- Name: nas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('nas_id_seq', 1, false);


--
-- Name: radacct; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE radacct (
    radacctid bigint NOT NULL,
    acctsessionid character varying(32) NOT NULL,
    acctuniqueid character varying(32) NOT NULL,
    username character varying(253),
    groupname character varying(253),
    realm character varying(64),
    nasipaddress inet NOT NULL,
    nasportid character varying(15),
    nasporttype character varying(32),
    acctstarttime timestamp with time zone,
    acctstoptime timestamp with time zone,
    acctsessiontime bigint,
    acctauthentic character varying(32),
    connectinfo_start character varying(50),
    connectinfo_stop character varying(50),
    acctinputoctets bigint DEFAULT 0,
    acctoutputoctets bigint DEFAULT 0,
    calledstationid character varying(50),
    callingstationid character varying(50),
    acctterminatecause character varying(32),
    servicetype character varying(32),
    framedprotocol character varying(32),
    framedipaddress inet,
    acctstartdelay bigint,
    acctstopdelay bigint,
    xascendsessionsvrkey character varying(10)
);


ALTER TABLE public.radacct OWNER TO postgres;

--
-- Name: radacct_radacctid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE radacct_radacctid_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.radacct_radacctid_seq OWNER TO postgres;

--
-- Name: radacct_radacctid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE radacct_radacctid_seq OWNED BY radacct.radacctid;


--
-- Name: radacct_radacctid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('radacct_radacctid_seq', 1, false);


--
-- Name: radcheck; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE radcheck (
    id integer NOT NULL,
    username character varying(64) DEFAULT ''::character varying NOT NULL,
    attribute character varying(64) DEFAULT ''::character varying NOT NULL,
    op character varying(2) DEFAULT '=='::character varying NOT NULL,
    value character varying(253) DEFAULT ''::character varying NOT NULL,
    pacc_id_accseries integer
);


ALTER TABLE public.radcheck OWNER TO postgres;

--
-- Name: radcheck_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE radcheck_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.radcheck_id_seq OWNER TO postgres;

--
-- Name: radcheck_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE radcheck_id_seq OWNED BY radcheck.id;


--
-- Name: radcheck_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('radcheck_id_seq', 1, false);


--
-- Name: radgroupcheck; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE radgroupcheck (
    id integer NOT NULL,
    groupname character varying(64) DEFAULT ''::character varying NOT NULL,
    attribute character varying(64) DEFAULT ''::character varying NOT NULL,
    op character varying(2) DEFAULT '=='::character varying NOT NULL,
    value character varying(253) DEFAULT ''::character varying NOT NULL
);


ALTER TABLE public.radgroupcheck OWNER TO postgres;

--
-- Name: radgroupcheck_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE radgroupcheck_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.radgroupcheck_id_seq OWNER TO postgres;

--
-- Name: radgroupcheck_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE radgroupcheck_id_seq OWNED BY radgroupcheck.id;


--
-- Name: radgroupcheck_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('radgroupcheck_id_seq', 1, false);


--
-- Name: radgroupreply; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE radgroupreply (
    id integer NOT NULL,
    groupname character varying(64) DEFAULT ''::character varying NOT NULL,
    attribute character varying(64) DEFAULT ''::character varying NOT NULL,
    op character varying(2) DEFAULT '='::character varying NOT NULL,
    value character varying(253) DEFAULT ''::character varying NOT NULL
);


ALTER TABLE public.radgroupreply OWNER TO postgres;

--
-- Name: radgroupreply_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE radgroupreply_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.radgroupreply_id_seq OWNER TO postgres;

--
-- Name: radgroupreply_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE radgroupreply_id_seq OWNED BY radgroupreply.id;


--
-- Name: radgroupreply_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('radgroupreply_id_seq', 1, false);


--
-- Name: radpostauth; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE radpostauth (
    id bigint NOT NULL,
    username character varying(253) NOT NULL,
    pass character varying(128),
    reply character varying(32),
    calledstationid character varying(50),
    callingstationid character varying(50),
    authdate timestamp with time zone DEFAULT '2006-07-18 14:36:09.068453+02'::timestamp with time zone NOT NULL
);


ALTER TABLE public.radpostauth OWNER TO postgres;

--
-- Name: radpostauth_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE radpostauth_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.radpostauth_id_seq OWNER TO postgres;

--
-- Name: radpostauth_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE radpostauth_id_seq OWNED BY radpostauth.id;


--
-- Name: radpostauth_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('radpostauth_id_seq', 1, false);


--
-- Name: radreply; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE radreply (
    id integer NOT NULL,
    username character varying(64) DEFAULT ''::character varying NOT NULL,
    attribute character varying(64) DEFAULT ''::character varying NOT NULL,
    op character varying(2) DEFAULT '='::character varying NOT NULL,
    value character varying(253) DEFAULT ''::character varying NOT NULL
);


ALTER TABLE public.radreply OWNER TO postgres;

--
-- Name: radreply_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE radreply_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.radreply_id_seq OWNER TO postgres;

--
-- Name: radreply_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE radreply_id_seq OWNED BY radreply.id;


--
-- Name: radreply_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('radreply_id_seq', 1, false);


--
-- Name: radusergroup; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE radusergroup (
    username character varying(64) DEFAULT ''::character varying NOT NULL,
    groupname character varying(64) DEFAULT ''::character varying NOT NULL,
    priority integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.radusergroup OWNER TO postgres;

--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_accseries ALTER COLUMN id SET DEFAULT nextval('acc_accseries_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_isporg ALTER COLUMN id SET DEFAULT nextval('acc_isporg_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_ispsuborg ALTER COLUMN id SET DEFAULT nextval('acc_ispsuborg_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_postpaccount ALTER COLUMN id SET DEFAULT nextval('acc_postpaccount_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_postpaccountlog ALTER COLUMN id SET DEFAULT nextval('acc_postpaccountlog_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_prepaccount ALTER COLUMN id SET DEFAULT nextval('acc_prepaccount_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_subscriberinfo ALTER COLUMN id SET DEFAULT nextval('acc_subscriberinfo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_systemuser ALTER COLUMN id SET DEFAULT nextval('acc_systemuser_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_usagedefinition ALTER COLUMN id SET DEFAULT nextval('acc_usagedefinition_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE nas ALTER COLUMN id SET DEFAULT nextval('nas_id_seq'::regclass);


--
-- Name: radacctid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE radacct ALTER COLUMN radacctid SET DEFAULT nextval('radacct_radacctid_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE radcheck ALTER COLUMN id SET DEFAULT nextval('radcheck_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE radgroupcheck ALTER COLUMN id SET DEFAULT nextval('radgroupcheck_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE radgroupreply ALTER COLUMN id SET DEFAULT nextval('radgroupreply_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE radpostauth ALTER COLUMN id SET DEFAULT nextval('radpostauth_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE radreply ALTER COLUMN id SET DEFAULT nextval('radreply_id_seq'::regclass);


--
-- Data for Name: acc_accseries; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: acc_isporg; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO acc_isporg VALUES (1, 'default', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ivan@primusnet.hr', 0, 'DEFAULT');


--
-- Data for Name: acc_ispsuborg; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO acc_ispsuborg VALUES (1, 'default', 1, NULL, '', NULL, '', '', NULL, 'DEFAULT_DEFAULT');


--
-- Data for Name: acc_postpaccount; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: acc_postpaccountlog; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: acc_prepaccount; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: acc_subscriberinfo; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: acc_systemuser; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO acc_systemuser VALUES (1, 'sysadmin', 'd04624c8454220026788650a2339d674', 'administrator', 1, 1, 'administrator', NULL, NULL, NULL, 'en');


--
-- Data for Name: acc_usagedefinition; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: nas; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: radacct; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: radcheck; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: radgroupcheck; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: radgroupreply; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: radpostauth; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: radreply; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: radusergroup; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: acc_accseries_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_accseries
    ADD CONSTRAINT acc_accseries_pkey PRIMARY KEY (id);


--
-- Name: acc_isporg_orgname_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_isporg
    ADD CONSTRAINT acc_isporg_orgname_key UNIQUE (orgname);


--
-- Name: acc_isporg_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_isporg
    ADD CONSTRAINT acc_isporg_pkey PRIMARY KEY (id);


--
-- Name: acc_postpacclogs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_postpaccountlog
    ADD CONSTRAINT acc_postpacclogs_pkey PRIMARY KEY (id);


--
-- Name: acc_postpaccount_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_postpaccount
    ADD CONSTRAINT acc_postpaccount_pkey PRIMARY KEY (id);


--
-- Name: acc_postpaccount_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_postpaccount
    ADD CONSTRAINT acc_postpaccount_username_key UNIQUE (username);


--
-- Name: acc_postporg_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_ispsuborg
    ADD CONSTRAINT acc_postporg_pkey PRIMARY KEY (id);


--
-- Name: acc_prepaccount_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_prepaccount
    ADD CONSTRAINT acc_prepaccount_pkey PRIMARY KEY (id);


--
-- Name: acc_prepaccount_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_prepaccount
    ADD CONSTRAINT acc_prepaccount_username_key UNIQUE (username);


--
-- Name: acc_subscriberinfo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_subscriberinfo
    ADD CONSTRAINT acc_subscriberinfo_pkey PRIMARY KEY (id);


--
-- Name: acc_systemuser_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_systemuser
    ADD CONSTRAINT acc_systemuser_pkey PRIMARY KEY (id);


--
-- Name: acc_usagedefinition_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_usagedefinition
    ADD CONSTRAINT acc_usagedefinition_pkey PRIMARY KEY (id);


--
-- Name: nas_nasname_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY nas
    ADD CONSTRAINT nas_nasname_key UNIQUE (nasname);


--
-- Name: nas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY nas
    ADD CONSTRAINT nas_pkey PRIMARY KEY (id);


--
-- Name: radacct_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY radacct
    ADD CONSTRAINT radacct_pkey PRIMARY KEY (radacctid);


--
-- Name: radcheck_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY radcheck
    ADD CONSTRAINT radcheck_pkey PRIMARY KEY (id);


--
-- Name: radgroupcheck_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY radgroupcheck
    ADD CONSTRAINT radgroupcheck_pkey PRIMARY KEY (id);


--
-- Name: radgroupreply_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY radgroupreply
    ADD CONSTRAINT radgroupreply_pkey PRIMARY KEY (id);


--
-- Name: radpostauth_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY radpostauth
    ADD CONSTRAINT radpostauth_pkey PRIMARY KEY (id);


--
-- Name: radreply_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY radreply
    ADD CONSTRAINT radreply_pkey PRIMARY KEY (id);


--
-- Name: nas_nasname; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX nas_nasname ON nas USING btree (nasname);


--
-- Name: radacct_active_user_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radacct_active_user_idx ON radacct USING btree (username, nasipaddress, acctsessionid) WHERE (acctstoptime IS NULL);


--
-- Name: radacct_start_user_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radacct_start_user_idx ON radacct USING btree (acctstarttime, username);


--
-- Name: radcheck_username; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radcheck_username ON radcheck USING btree (username, attribute);


--
-- Name: radgroupcheck_groupname; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radgroupcheck_groupname ON radgroupcheck USING btree (groupname, attribute);


--
-- Name: radgroupreply_groupname; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radgroupreply_groupname ON radgroupreply USING btree (groupname, attribute);


--
-- Name: radreply_username; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radreply_username ON radreply USING btree (username, attribute);


--
-- Name: usergroup_username; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX usergroup_username ON radusergroup USING btree (username);


--
-- Name: trig_radacct; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trig_radacct
    AFTER UPDATE ON radacct
    FOR EACH ROW
    EXECUTE PROCEDURE process_acc();


--
-- Name: acc_accseries_fk1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_accseries
    ADD CONSTRAINT acc_accseries_fk1 FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id) ON UPDATE CASCADE;


--
-- Name: acc_accseries_fk2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_accseries
    ADD CONSTRAINT acc_accseries_fk2 FOREIGN KEY (id_usagedefinition) REFERENCES acc_usagedefinition(id) ON UPDATE CASCADE;


--
-- Name: acc_accseries_fk3; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_accseries
    ADD CONSTRAINT acc_accseries_fk3 FOREIGN KEY (id_systemuser) REFERENCES acc_systemuser(id) ON UPDATE CASCADE;


--
-- Name: acc_accseries_id_ispsuborg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_accseries
    ADD CONSTRAINT acc_accseries_id_ispsuborg_fkey FOREIGN KEY (id_ispsuborg) REFERENCES acc_ispsuborg(id);


--
-- Name: acc_postpacclogs_id_postpaccount_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_postpaccountlog
    ADD CONSTRAINT acc_postpacclogs_id_postpaccount_fkey FOREIGN KEY (id_postpaccount) REFERENCES acc_postpaccount(id);


--
-- Name: acc_postpaccount_id_accseries_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_postpaccount
    ADD CONSTRAINT acc_postpaccount_id_accseries_fkey FOREIGN KEY (id_accseries) REFERENCES acc_accseries(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: acc_postpaccount_id_isporg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_postpaccount
    ADD CONSTRAINT acc_postpaccount_id_isporg_fkey FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id);


--
-- Name: acc_postpaccount_id_ispsuborg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_postpaccount
    ADD CONSTRAINT acc_postpaccount_id_ispsuborg_fkey FOREIGN KEY (id_ispsuborg) REFERENCES acc_ispsuborg(id);


--
-- Name: acc_postpaccountlog_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_postpaccountlog
    ADD CONSTRAINT acc_postpaccountlog_fk FOREIGN KEY (id_systemuser) REFERENCES acc_systemuser(id);


--
-- Name: acc_postpaccountlog_id_usagedefinition_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_postpaccountlog
    ADD CONSTRAINT acc_postpaccountlog_id_usagedefinition_fkey FOREIGN KEY (id_usagedefinition) REFERENCES acc_usagedefinition(id);


--
-- Name: acc_postporg_id_isporg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_ispsuborg
    ADD CONSTRAINT acc_postporg_id_isporg_fkey FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id);


--
-- Name: acc_prepaccount_id_accseries_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_prepaccount
    ADD CONSTRAINT acc_prepaccount_id_accseries_fkey FOREIGN KEY (id_accseries) REFERENCES acc_accseries(id);


--
-- Name: acc_prepaccount_id_isporg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_prepaccount
    ADD CONSTRAINT acc_prepaccount_id_isporg_fkey FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id);


--
-- Name: acc_prepaccount_id_ispsuborg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_prepaccount
    ADD CONSTRAINT acc_prepaccount_id_ispsuborg_fkey FOREIGN KEY (id_ispsuborg) REFERENCES acc_ispsuborg(id);


--
-- Name: acc_prepaccount_id_systemuser_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_prepaccount
    ADD CONSTRAINT acc_prepaccount_id_systemuser_fkey FOREIGN KEY (id_systemuser) REFERENCES acc_systemuser(id);


--
-- Name: acc_subscriberinfo_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_subscriberinfo
    ADD CONSTRAINT acc_subscriberinfo_fk FOREIGN KEY (id_accseries) REFERENCES acc_accseries(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: acc_systemuser_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_systemuser
    ADD CONSTRAINT acc_systemuser_fk FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id) ON UPDATE CASCADE;


--
-- Name: acc_systemuser_id_ispsuborg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_systemuser
    ADD CONSTRAINT acc_systemuser_id_ispsuborg_fkey FOREIGN KEY (id_ispsuborg) REFERENCES acc_ispsuborg(id);


--
-- Name: acc_usagedefinition_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_usagedefinition
    ADD CONSTRAINT acc_usagedefinition_fk FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id) ON UPDATE CASCADE;


--
-- Name: nas_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY nas
    ADD CONSTRAINT nas_fk FOREIGN KEY (pacc_id_isporg) REFERENCES acc_isporg(id) ON UPDATE CASCADE;


--
-- Name: nas_pacc_id_ispsuborg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY nas
    ADD CONSTRAINT nas_pacc_id_ispsuborg_fkey FOREIGN KEY (pacc_id_ispsuborg) REFERENCES acc_ispsuborg(id);


--
-- Name: radcheck_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radcheck
    ADD CONSTRAINT radcheck_fk FOREIGN KEY (pacc_id_accseries) REFERENCES acc_accseries(id) ON UPDATE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

