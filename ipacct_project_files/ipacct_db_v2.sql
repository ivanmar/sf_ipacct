--
-- PostgreSQL database dump
--

-- Started on 2010-05-10 14:47:24 CEST

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

--
-- TOC entry 359 (class 2612 OID 16387)
-- Name: plpgsql; Type: PROCEDURAL LANGUAGE; Schema: -; Owner: postgres
--

CREATE PROCEDURAL LANGUAGE plpgsql;


ALTER PROCEDURAL LANGUAGE plpgsql OWNER TO postgres;

SET search_path = public, pg_catalog;

--
-- TOC entry 19 (class 1255 OID 16391)
-- Dependencies: 6 359
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
-- TOC entry 1546 (class 1259 OID 16392)
-- Dependencies: 1856 6
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
-- TOC entry 1996 (class 0 OID 0)
-- Dependencies: 1546
-- Name: COLUMN acc_accseries.id_systemuser; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_accseries.id_systemuser IS 'created by';


--
-- TOC entry 1997 (class 0 OID 0)
-- Dependencies: 1546
-- Name: COLUMN acc_accseries.acctype; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_accseries.acctype IS 'prepaid postpaid subscriber';


--
-- TOC entry 1547 (class 1259 OID 16396)
-- Dependencies: 1546 6
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
-- TOC entry 1998 (class 0 OID 0)
-- Dependencies: 1547
-- Name: acc_accseries_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_accseries_id_seq OWNED BY acc_accseries.id;


--
-- TOC entry 1999 (class 0 OID 0)
-- Dependencies: 1547
-- Name: acc_accseries_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_accseries_id_seq', 1, false);


--
-- TOC entry 1548 (class 1259 OID 16398)
-- Dependencies: 1858 6
-- Name: acc_isporg; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE acc_isporg (
    id integer NOT NULL,
    name character varying(256) NOT NULL,
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
-- TOC entry 2000 (class 0 OID 0)
-- Dependencies: 1548
-- Name: COLUMN acc_isporg.radlocation; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_isporg.radlocation IS 'top level radius location ID';


--
-- TOC entry 1549 (class 1259 OID 16405)
-- Dependencies: 1548 6
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
-- TOC entry 2001 (class 0 OID 0)
-- Dependencies: 1549
-- Name: acc_isporg_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_isporg_id_seq OWNED BY acc_isporg.id;


--
-- TOC entry 2002 (class 0 OID 0)
-- Dependencies: 1549
-- Name: acc_isporg_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_isporg_id_seq', 1, false);


--
-- TOC entry 1550 (class 1259 OID 16407)
-- Dependencies: 6
-- Name: acc_ispsuborg; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE acc_ispsuborg (
    id integer NOT NULL,
    name character varying(128) NOT NULL,
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
-- TOC entry 2003 (class 0 OID 0)
-- Dependencies: 1550
-- Name: COLUMN acc_ispsuborg.radlocation; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_ispsuborg.radlocation IS 'sub level radius location ID';


--
-- TOC entry 1551 (class 1259 OID 16413)
-- Dependencies: 1550 6
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
-- TOC entry 2004 (class 0 OID 0)
-- Dependencies: 1551
-- Name: acc_ispsuborg_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_ispsuborg_id_seq OWNED BY acc_ispsuborg.id;


--
-- TOC entry 2005 (class 0 OID 0)
-- Dependencies: 1551
-- Name: acc_ispsuborg_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_ispsuborg_id_seq', 1, false);


--
-- TOC entry 1552 (class 1259 OID 16415)
-- Dependencies: 1861 6
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
-- TOC entry 1553 (class 1259 OID 16419)
-- Dependencies: 1552 6
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
-- TOC entry 2006 (class 0 OID 0)
-- Dependencies: 1553
-- Name: acc_postpaccount_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_postpaccount_id_seq OWNED BY acc_postpaccount.id;


--
-- TOC entry 2007 (class 0 OID 0)
-- Dependencies: 1553
-- Name: acc_postpaccount_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_postpaccount_id_seq', 1, false);


--
-- TOC entry 1554 (class 1259 OID 16421)
-- Dependencies: 1863 1864 6
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
-- TOC entry 2008 (class 0 OID 0)
-- Dependencies: 1554
-- Name: COLUMN acc_postpaccountlog.timespent; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_postpaccountlog.timespent IS 'seconds';


--
-- TOC entry 2009 (class 0 OID 0)
-- Dependencies: 1554
-- Name: COLUMN acc_postpaccountlog.trafficspent; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_postpaccountlog.trafficspent IS 'bytes';


--
-- TOC entry 2010 (class 0 OID 0)
-- Dependencies: 1554
-- Name: COLUMN acc_postpaccountlog.id_usagedefinition; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_postpaccountlog.id_usagedefinition IS 'historical billing';


--
-- TOC entry 1555 (class 1259 OID 16426)
-- Dependencies: 1554 6
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
-- TOC entry 2011 (class 0 OID 0)
-- Dependencies: 1555
-- Name: acc_postpaccountlog_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_postpaccountlog_id_seq OWNED BY acc_postpaccountlog.id;


--
-- TOC entry 2012 (class 0 OID 0)
-- Dependencies: 1555
-- Name: acc_postpaccountlog_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_postpaccountlog_id_seq', 1, false);


--
-- TOC entry 1556 (class 1259 OID 16428)
-- Dependencies: 6
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
-- TOC entry 2013 (class 0 OID 0)
-- Dependencies: 1556
-- Name: COLUMN acc_prepaccount.id_systemuser; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_prepaccount.id_systemuser IS 'sold by';


--
-- TOC entry 2014 (class 0 OID 0)
-- Dependencies: 1556
-- Name: COLUMN acc_prepaccount.s_card; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_prepaccount.s_card IS 'storn id';


--
-- TOC entry 2015 (class 0 OID 0)
-- Dependencies: 1556
-- Name: COLUMN acc_prepaccount.timespent; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_prepaccount.timespent IS 'seconds';


--
-- TOC entry 1557 (class 1259 OID 16431)
-- Dependencies: 6 1556
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
-- TOC entry 2016 (class 0 OID 0)
-- Dependencies: 1557
-- Name: acc_prepaccount_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_prepaccount_id_seq OWNED BY acc_prepaccount.id;


--
-- TOC entry 2017 (class 0 OID 0)
-- Dependencies: 1557
-- Name: acc_prepaccount_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_prepaccount_id_seq', 1, false);


--
-- TOC entry 1558 (class 1259 OID 16433)
-- Dependencies: 6
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
-- TOC entry 1559 (class 1259 OID 16439)
-- Dependencies: 6 1558
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
-- TOC entry 2018 (class 0 OID 0)
-- Dependencies: 1559
-- Name: acc_subscriberinfo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_subscriberinfo_id_seq OWNED BY acc_subscriberinfo.id;


--
-- TOC entry 2019 (class 0 OID 0)
-- Dependencies: 1559
-- Name: acc_subscriberinfo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_subscriberinfo_id_seq', 1, false);


--
-- TOC entry 1560 (class 1259 OID 16441)
-- Dependencies: 6
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
-- TOC entry 2020 (class 0 OID 0)
-- Dependencies: 1560
-- Name: COLUMN acc_systemuser.acctype; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_systemuser.acctype IS 'administrator or operator';


--
-- TOC entry 1561 (class 1259 OID 16444)
-- Dependencies: 6 1560
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
-- TOC entry 2021 (class 0 OID 0)
-- Dependencies: 1561
-- Name: acc_systemuser_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_systemuser_id_seq OWNED BY acc_systemuser.id;


--
-- TOC entry 2022 (class 0 OID 0)
-- Dependencies: 1561
-- Name: acc_systemuser_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_systemuser_id_seq', 1, false);


--
-- TOC entry 1562 (class 1259 OID 16446)
-- Dependencies: 1869 1870 1871 6
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
-- TOC entry 2023 (class 0 OID 0)
-- Dependencies: 1562
-- Name: COLUMN acc_usagedefinition.acctype; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_usagedefinition.acctype IS 'prepaid postpaid subscriber';


--
-- TOC entry 2024 (class 0 OID 0)
-- Dependencies: 1562
-- Name: COLUMN acc_usagedefinition.measureunit; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN acc_usagedefinition.measureunit IS 'kb or min or card';


--
-- TOC entry 1563 (class 1259 OID 16452)
-- Dependencies: 1562 6
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
-- TOC entry 2025 (class 0 OID 0)
-- Dependencies: 1563
-- Name: acc_usagedefinition_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acc_usagedefinition_id_seq OWNED BY acc_usagedefinition.id;


--
-- TOC entry 2026 (class 0 OID 0)
-- Dependencies: 1563
-- Name: acc_usagedefinition_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acc_usagedefinition_id_seq', 1, false);


--
-- TOC entry 1564 (class 1259 OID 16454)
-- Dependencies: 1873 6
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
    id_isporg integer NOT NULL,
    pacc_nasipaddress inet,
    pacc_conn_user character varying(32),
    pacc_conn_pass character varying(32),
    pacc_admin_user character varying(32),
    pacc_admin_pass character varying(32),
    id_ispsuborg integer,
    pacc_macaddress character varying(50),
    pacc_ssid character varying(32),
    pacc_radlocation character varying(32),
    pacc_adminport integer
);


ALTER TABLE public.nas OWNER TO postgres;

--
-- TOC entry 2027 (class 0 OID 0)
-- Dependencies: 1564
-- Name: COLUMN nas.shortname; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN nas.shortname IS 'shortname or dynamic dns name for virtual nases';


--
-- TOC entry 2028 (class 0 OID 0)
-- Dependencies: 1564
-- Name: COLUMN nas.pacc_conn_pass; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN nas.pacc_conn_pass IS 'passw za adsl';


--
-- TOC entry 2029 (class 0 OID 0)
-- Dependencies: 1564
-- Name: COLUMN nas.pacc_admin_pass; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN nas.pacc_admin_pass IS 'passw za hotspot';


--
-- TOC entry 2030 (class 0 OID 0)
-- Dependencies: 1564
-- Name: COLUMN nas.pacc_radlocation; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN nas.pacc_radlocation IS 'only used for information';


--
-- TOC entry 1565 (class 1259 OID 16461)
-- Dependencies: 6 1564
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
-- TOC entry 2031 (class 0 OID 0)
-- Dependencies: 1565
-- Name: nas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE nas_id_seq OWNED BY nas.id;


--
-- TOC entry 2032 (class 0 OID 0)
-- Dependencies: 1565
-- Name: nas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('nas_id_seq', 1, false);


--
-- TOC entry 1566 (class 1259 OID 16463)
-- Dependencies: 1875 1876 6
-- Name: radacct; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE radacct (
    id bigint NOT NULL,
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
-- TOC entry 1567 (class 1259 OID 16471)
-- Dependencies: 6 1566
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
-- TOC entry 2033 (class 0 OID 0)
-- Dependencies: 1567
-- Name: radacct_radacctid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE radacct_radacctid_seq OWNED BY radacct.id;


--
-- TOC entry 2034 (class 0 OID 0)
-- Dependencies: 1567
-- Name: radacct_radacctid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('radacct_radacctid_seq', 1, false);


--
-- TOC entry 1568 (class 1259 OID 16473)
-- Dependencies: 1878 1879 1880 1881 6
-- Name: radcheck; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE radcheck (
    id integer NOT NULL,
    username character varying(64) DEFAULT ''::character varying NOT NULL,
    attr character varying(64) DEFAULT ''::character varying NOT NULL,
    op character varying(2) DEFAULT '=='::character varying NOT NULL,
    value character varying(253) DEFAULT ''::character varying NOT NULL,
    id_accseries integer
);


ALTER TABLE public.radcheck OWNER TO postgres;

--
-- TOC entry 1569 (class 1259 OID 16480)
-- Dependencies: 1568 6
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
-- TOC entry 2035 (class 0 OID 0)
-- Dependencies: 1569
-- Name: radcheck_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE radcheck_id_seq OWNED BY radcheck.id;


--
-- TOC entry 2036 (class 0 OID 0)
-- Dependencies: 1569
-- Name: radcheck_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('radcheck_id_seq', 1, false);


--
-- TOC entry 1570 (class 1259 OID 16482)
-- Dependencies: 1883 1884 1885 1886 6
-- Name: radgroupcheck; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE radgroupcheck (
    id integer NOT NULL,
    groupname character varying(64) DEFAULT ''::character varying NOT NULL,
    attr character varying(64) DEFAULT ''::character varying NOT NULL,
    op character varying(2) DEFAULT '=='::character varying NOT NULL,
    value character varying(253) DEFAULT ''::character varying NOT NULL
);


ALTER TABLE public.radgroupcheck OWNER TO postgres;

--
-- TOC entry 1571 (class 1259 OID 16489)
-- Dependencies: 1570 6
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
-- TOC entry 2037 (class 0 OID 0)
-- Dependencies: 1571
-- Name: radgroupcheck_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE radgroupcheck_id_seq OWNED BY radgroupcheck.id;


--
-- TOC entry 2038 (class 0 OID 0)
-- Dependencies: 1571
-- Name: radgroupcheck_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('radgroupcheck_id_seq', 1, false);


--
-- TOC entry 1572 (class 1259 OID 16491)
-- Dependencies: 1888 1889 1890 1891 6
-- Name: radgroupreply; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE radgroupreply (
    id integer NOT NULL,
    groupname character varying(64) DEFAULT ''::character varying NOT NULL,
    attr character varying(64) DEFAULT ''::character varying NOT NULL,
    op character varying(2) DEFAULT '='::character varying NOT NULL,
    value character varying(253) DEFAULT ''::character varying NOT NULL
);


ALTER TABLE public.radgroupreply OWNER TO postgres;

--
-- TOC entry 1573 (class 1259 OID 16498)
-- Dependencies: 6 1572
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
-- TOC entry 2039 (class 0 OID 0)
-- Dependencies: 1573
-- Name: radgroupreply_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE radgroupreply_id_seq OWNED BY radgroupreply.id;


--
-- TOC entry 2040 (class 0 OID 0)
-- Dependencies: 1573
-- Name: radgroupreply_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('radgroupreply_id_seq', 1, false);


--
-- TOC entry 1574 (class 1259 OID 16500)
-- Dependencies: 1893 6
-- Name: radpostauth; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE radpostauth (
    id bigint NOT NULL,
    username character varying(253) NOT NULL,
    pass character varying(128),
    reply character varying(32),
    calledstationid character varying(50),
    callingstationid character varying(50),
    authdate timestamp NOT NULL
);


ALTER TABLE public.radpostauth OWNER TO postgres;

--
-- TOC entry 1575 (class 1259 OID 16507)
-- Dependencies: 1574 6
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
-- TOC entry 2041 (class 0 OID 0)
-- Dependencies: 1575
-- Name: radpostauth_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE radpostauth_id_seq OWNED BY radpostauth.id;


--
-- TOC entry 2042 (class 0 OID 0)
-- Dependencies: 1575
-- Name: radpostauth_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('radpostauth_id_seq', 1, false);


--
-- TOC entry 1576 (class 1259 OID 16509)
-- Dependencies: 1895 1896 1897 1898 6
-- Name: radreply; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE radreply (
    id integer NOT NULL,
    username character varying(64) DEFAULT ''::character varying NOT NULL,
    attr character varying(64) DEFAULT ''::character varying NOT NULL,
    op character varying(2) DEFAULT '='::character varying NOT NULL,
    value character varying(253) DEFAULT ''::character varying NOT NULL
);


ALTER TABLE public.radreply OWNER TO postgres;

--
-- TOC entry 1577 (class 1259 OID 16516)
-- Dependencies: 6 1576
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
-- TOC entry 2043 (class 0 OID 0)
-- Dependencies: 1577
-- Name: radreply_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE radreply_id_seq OWNED BY radreply.id;


--
-- TOC entry 2044 (class 0 OID 0)
-- Dependencies: 1577
-- Name: radreply_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('radreply_id_seq', 1, false);


--
-- TOC entry 1578 (class 1259 OID 16518)
-- Dependencies: 1900 1901 1902 6
-- Name: radusergroup; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE radusergroup (
    username character varying(64) DEFAULT ''::character varying NOT NULL,
    groupname character varying(64) DEFAULT ''::character varying NOT NULL,
    priority integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.radusergroup OWNER TO postgres;

--
-- TOC entry 1857 (class 2604 OID 16524)
-- Dependencies: 1547 1546
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_accseries ALTER COLUMN id SET DEFAULT nextval('acc_accseries_id_seq'::regclass);


--
-- TOC entry 1859 (class 2604 OID 16525)
-- Dependencies: 1549 1548
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_isporg ALTER COLUMN id SET DEFAULT nextval('acc_isporg_id_seq'::regclass);


--
-- TOC entry 1860 (class 2604 OID 16526)
-- Dependencies: 1551 1550
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_ispsuborg ALTER COLUMN id SET DEFAULT nextval('acc_ispsuborg_id_seq'::regclass);


--
-- TOC entry 1862 (class 2604 OID 16527)
-- Dependencies: 1553 1552
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_postpaccount ALTER COLUMN id SET DEFAULT nextval('acc_postpaccount_id_seq'::regclass);


--
-- TOC entry 1865 (class 2604 OID 16528)
-- Dependencies: 1555 1554
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_postpaccountlog ALTER COLUMN id SET DEFAULT nextval('acc_postpaccountlog_id_seq'::regclass);


--
-- TOC entry 1866 (class 2604 OID 16529)
-- Dependencies: 1557 1556
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_prepaccount ALTER COLUMN id SET DEFAULT nextval('acc_prepaccount_id_seq'::regclass);


--
-- TOC entry 1867 (class 2604 OID 16530)
-- Dependencies: 1559 1558
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_subscriberinfo ALTER COLUMN id SET DEFAULT nextval('acc_subscriberinfo_id_seq'::regclass);


--
-- TOC entry 1868 (class 2604 OID 16531)
-- Dependencies: 1561 1560
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_systemuser ALTER COLUMN id SET DEFAULT nextval('acc_systemuser_id_seq'::regclass);


--
-- TOC entry 1872 (class 2604 OID 16532)
-- Dependencies: 1563 1562
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acc_usagedefinition ALTER COLUMN id SET DEFAULT nextval('acc_usagedefinition_id_seq'::regclass);


--
-- TOC entry 1874 (class 2604 OID 16533)
-- Dependencies: 1565 1564
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE nas ALTER COLUMN id SET DEFAULT nextval('nas_id_seq'::regclass);


--
-- TOC entry 1877 (class 2604 OID 16534)
-- Dependencies: 1567 1566
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE radacct ALTER COLUMN id SET DEFAULT nextval('radacct_radacctid_seq'::regclass);


--
-- TOC entry 1882 (class 2604 OID 16535)
-- Dependencies: 1569 1568
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE radcheck ALTER COLUMN id SET DEFAULT nextval('radcheck_id_seq'::regclass);


--
-- TOC entry 1887 (class 2604 OID 16536)
-- Dependencies: 1571 1570
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE radgroupcheck ALTER COLUMN id SET DEFAULT nextval('radgroupcheck_id_seq'::regclass);


--
-- TOC entry 1892 (class 2604 OID 16537)
-- Dependencies: 1573 1572
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE radgroupreply ALTER COLUMN id SET DEFAULT nextval('radgroupreply_id_seq'::regclass);


--
-- TOC entry 1894 (class 2604 OID 16538)
-- Dependencies: 1575 1574
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE radpostauth ALTER COLUMN id SET DEFAULT nextval('radpostauth_id_seq'::regclass);


--
-- TOC entry 1899 (class 2604 OID 16539)
-- Dependencies: 1577 1576
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE radreply ALTER COLUMN id SET DEFAULT nextval('radreply_id_seq'::regclass);


--
-- TOC entry 1974 (class 0 OID 16392)
-- Dependencies: 1546
-- Data for Name: acc_accseries; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 1975 (class 0 OID 16398)
-- Dependencies: 1548
-- Data for Name: acc_isporg; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO acc_isporg (id, name, address, city, zipcode, phone, billinginfo, contactname, email_report, email_nasadmin, pst_commission, radlocation) VALUES (1, 'default', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ivan@primusnet.hr', 0, 'DEFAULT');


--
-- TOC entry 1976 (class 0 OID 16407)
-- Dependencies: 1550
-- Data for Name: acc_ispsuborg; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO acc_ispsuborg (id, name, id_isporg, address, city, zipcode, phone, email, contactname, radlocation) VALUES (1, 'default', 1, NULL, '', NULL, '', '', NULL, 'DEFAULT_DEFAULT');


--
-- TOC entry 1977 (class 0 OID 16415)
-- Dependencies: 1552
-- Data for Name: acc_postpaccount; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 1978 (class 0 OID 16421)
-- Dependencies: 1554
-- Data for Name: acc_postpaccountlog; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 1979 (class 0 OID 16428)
-- Dependencies: 1556
-- Data for Name: acc_prepaccount; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 1980 (class 0 OID 16433)
-- Dependencies: 1558
-- Data for Name: acc_subscriberinfo; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 1981 (class 0 OID 16441)
-- Dependencies: 1560
-- Data for Name: acc_systemuser; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO acc_systemuser (id, username, pass, acctype, id_isporg, id_ispsuborg, name, email, phone, mobile, lang) VALUES (1, 'sysadmin', 'd04624c8454220026788650a2339d674', 'administrator', 1, 1, 'administrator', NULL, NULL, NULL, 'en');


--
-- TOC entry 1982 (class 0 OID 16446)
-- Dependencies: 1562
-- Data for Name: acc_usagedefinition; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 1983 (class 0 OID 16454)
-- Dependencies: 1564
-- Data for Name: nas; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 1984 (class 0 OID 16463)
-- Dependencies: 1566
-- Data for Name: radacct; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 1985 (class 0 OID 16473)
-- Dependencies: 1568
-- Data for Name: radcheck; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 1986 (class 0 OID 16482)
-- Dependencies: 1570
-- Data for Name: radgroupcheck; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 1987 (class 0 OID 16491)
-- Dependencies: 1572
-- Data for Name: radgroupreply; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 1988 (class 0 OID 16500)
-- Dependencies: 1574
-- Data for Name: radpostauth; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 1989 (class 0 OID 16509)
-- Dependencies: 1576
-- Data for Name: radreply; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 1990 (class 0 OID 16518)
-- Dependencies: 1578
-- Data for Name: radusergroup; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 1904 (class 2606 OID 16541)
-- Dependencies: 1546 1546
-- Name: acc_accseries_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_accseries
    ADD CONSTRAINT acc_accseries_pkey PRIMARY KEY (id);


--
-- TOC entry 1906 (class 2606 OID 16543)
-- Dependencies: 1548 1548
-- Name: acc_isporg_orgname_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_isporg
    ADD CONSTRAINT acc_isporg_orgname_key UNIQUE (name);


--
-- TOC entry 1908 (class 2606 OID 16545)
-- Dependencies: 1548 1548
-- Name: acc_isporg_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_isporg
    ADD CONSTRAINT acc_isporg_pkey PRIMARY KEY (id);


--
-- TOC entry 1916 (class 2606 OID 16547)
-- Dependencies: 1554 1554
-- Name: acc_postpacclogs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_postpaccountlog
    ADD CONSTRAINT acc_postpacclogs_pkey PRIMARY KEY (id);


--
-- TOC entry 1912 (class 2606 OID 16549)
-- Dependencies: 1552 1552
-- Name: acc_postpaccount_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_postpaccount
    ADD CONSTRAINT acc_postpaccount_pkey PRIMARY KEY (id);


--
-- TOC entry 1914 (class 2606 OID 16551)
-- Dependencies: 1552 1552
-- Name: acc_postpaccount_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_postpaccount
    ADD CONSTRAINT acc_postpaccount_username_key UNIQUE (username);


--
-- TOC entry 1910 (class 2606 OID 16553)
-- Dependencies: 1550 1550
-- Name: acc_postporg_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_ispsuborg
    ADD CONSTRAINT acc_postporg_pkey PRIMARY KEY (id);


--
-- TOC entry 1918 (class 2606 OID 16555)
-- Dependencies: 1556 1556
-- Name: acc_prepaccount_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_prepaccount
    ADD CONSTRAINT acc_prepaccount_pkey PRIMARY KEY (id);


--
-- TOC entry 1920 (class 2606 OID 16557)
-- Dependencies: 1556 1556
-- Name: acc_prepaccount_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_prepaccount
    ADD CONSTRAINT acc_prepaccount_username_key UNIQUE (username);


--
-- TOC entry 1922 (class 2606 OID 16559)
-- Dependencies: 1558 1558
-- Name: acc_subscriberinfo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_subscriberinfo
    ADD CONSTRAINT acc_subscriberinfo_pkey PRIMARY KEY (id);


--
-- TOC entry 1924 (class 2606 OID 16561)
-- Dependencies: 1560 1560
-- Name: acc_systemuser_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_systemuser
    ADD CONSTRAINT acc_systemuser_pkey PRIMARY KEY (id);


--
-- TOC entry 1926 (class 2606 OID 16563)
-- Dependencies: 1562 1562
-- Name: acc_usagedefinition_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acc_usagedefinition
    ADD CONSTRAINT acc_usagedefinition_pkey PRIMARY KEY (id);


--
-- TOC entry 1929 (class 2606 OID 16565)
-- Dependencies: 1564 1564
-- Name: nas_nasname_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY nas
    ADD CONSTRAINT nas_nasname_key UNIQUE (nasname);


--
-- TOC entry 1931 (class 2606 OID 16567)
-- Dependencies: 1564 1564
-- Name: nas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY nas
    ADD CONSTRAINT nas_pkey PRIMARY KEY (id);


--
-- TOC entry 1934 (class 2606 OID 16569)
-- Dependencies: 1566 1566
-- Name: radacct_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY radacct
    ADD CONSTRAINT radacct_pkey PRIMARY KEY (id);


--
-- TOC entry 1937 (class 2606 OID 16571)
-- Dependencies: 1568 1568
-- Name: radcheck_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY radcheck
    ADD CONSTRAINT radcheck_pkey PRIMARY KEY (id);


--
-- TOC entry 1941 (class 2606 OID 16573)
-- Dependencies: 1570 1570
-- Name: radgroupcheck_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY radgroupcheck
    ADD CONSTRAINT radgroupcheck_pkey PRIMARY KEY (id);


--
-- TOC entry 1944 (class 2606 OID 16575)
-- Dependencies: 1572 1572
-- Name: radgroupreply_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY radgroupreply
    ADD CONSTRAINT radgroupreply_pkey PRIMARY KEY (id);


--
-- TOC entry 1946 (class 2606 OID 16577)
-- Dependencies: 1574 1574
-- Name: radpostauth_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY radpostauth
    ADD CONSTRAINT radpostauth_pkey PRIMARY KEY (id);


--
-- TOC entry 1948 (class 2606 OID 16579)
-- Dependencies: 1576 1576
-- Name: radreply_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY radreply
    ADD CONSTRAINT radreply_pkey PRIMARY KEY (id);


--
-- TOC entry 1927 (class 1259 OID 16580)
-- Dependencies: 1564
-- Name: nas_nasname; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX nas_nasname ON nas USING btree (nasname);


--
-- TOC entry 1932 (class 1259 OID 16581)
-- Dependencies: 1566 1566 1566 1566
-- Name: radacct_active_user_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radacct_active_user_idx ON radacct USING btree (username, nasipaddress, acctsessionid) WHERE (acctstoptime IS NULL);


--
-- TOC entry 1935 (class 1259 OID 16582)
-- Dependencies: 1566 1566
-- Name: radacct_start_user_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radacct_start_user_idx ON radacct USING btree (acctstarttime, username);


--
-- TOC entry 1938 (class 1259 OID 16583)
-- Dependencies: 1568 1568
-- Name: radcheck_username; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radcheck_username ON radcheck USING btree (username, attr);


--
-- TOC entry 1939 (class 1259 OID 16584)
-- Dependencies: 1570 1570
-- Name: radgroupcheck_groupname; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radgroupcheck_groupname ON radgroupcheck USING btree (groupname, attr);


--
-- TOC entry 1942 (class 1259 OID 16585)
-- Dependencies: 1572 1572
-- Name: radgroupreply_groupname; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radgroupreply_groupname ON radgroupreply USING btree (groupname, attr);


--
-- TOC entry 1949 (class 1259 OID 16586)
-- Dependencies: 1576 1576
-- Name: radreply_username; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radreply_username ON radreply USING btree (username, attr);


--
-- TOC entry 1950 (class 1259 OID 16587)
-- Dependencies: 1578
-- Name: usergroup_username; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX usergroup_username ON radusergroup USING btree (username);


--
-- TOC entry 1973 (class 2620 OID 16588)
-- Dependencies: 19 1566
-- Name: trig_radacct; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trig_radacct
    AFTER UPDATE ON radacct
    FOR EACH ROW
    EXECUTE PROCEDURE process_acc();


--
-- TOC entry 1951 (class 2606 OID 16589)
-- Dependencies: 1546 1548 1907
-- Name: acc_accseries_fk1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_accseries
    ADD CONSTRAINT acc_accseries_fk1 FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id) ON UPDATE CASCADE;


--
-- TOC entry 1952 (class 2606 OID 16594)
-- Dependencies: 1546 1925 1562
-- Name: acc_accseries_fk2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_accseries
    ADD CONSTRAINT acc_accseries_fk2 FOREIGN KEY (id_usagedefinition) REFERENCES acc_usagedefinition(id) ON UPDATE CASCADE;


--
-- TOC entry 1953 (class 2606 OID 16599)
-- Dependencies: 1923 1560 1546
-- Name: acc_accseries_fk3; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_accseries
    ADD CONSTRAINT acc_accseries_fk3 FOREIGN KEY (id_systemuser) REFERENCES acc_systemuser(id) ON UPDATE CASCADE;


--
-- TOC entry 1954 (class 2606 OID 16604)
-- Dependencies: 1546 1909 1550
-- Name: acc_accseries_id_ispsuborg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_accseries
    ADD CONSTRAINT acc_accseries_id_ispsuborg_fkey FOREIGN KEY (id_ispsuborg) REFERENCES acc_ispsuborg(id);


--
-- TOC entry 1959 (class 2606 OID 16609)
-- Dependencies: 1552 1554 1911
-- Name: acc_postpacclogs_id_postpaccount_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_postpaccountlog
    ADD CONSTRAINT acc_postpacclogs_id_postpaccount_fkey FOREIGN KEY (id_postpaccount) REFERENCES acc_postpaccount(id);


--
-- TOC entry 1956 (class 2606 OID 16614)
-- Dependencies: 1903 1552 1546
-- Name: acc_postpaccount_id_accseries_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_postpaccount
    ADD CONSTRAINT acc_postpaccount_id_accseries_fkey FOREIGN KEY (id_accseries) REFERENCES acc_accseries(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 1957 (class 2606 OID 16619)
-- Dependencies: 1907 1548 1552
-- Name: acc_postpaccount_id_isporg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_postpaccount
    ADD CONSTRAINT acc_postpaccount_id_isporg_fkey FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id);


--
-- TOC entry 1958 (class 2606 OID 16624)
-- Dependencies: 1909 1550 1552
-- Name: acc_postpaccount_id_ispsuborg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_postpaccount
    ADD CONSTRAINT acc_postpaccount_id_ispsuborg_fkey FOREIGN KEY (id_ispsuborg) REFERENCES acc_ispsuborg(id);


--
-- TOC entry 1960 (class 2606 OID 16629)
-- Dependencies: 1560 1554 1923
-- Name: acc_postpaccountlog_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_postpaccountlog
    ADD CONSTRAINT acc_postpaccountlog_fk FOREIGN KEY (id_systemuser) REFERENCES acc_systemuser(id);


--
-- TOC entry 1961 (class 2606 OID 16634)
-- Dependencies: 1925 1562 1554
-- Name: acc_postpaccountlog_id_usagedefinition_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_postpaccountlog
    ADD CONSTRAINT acc_postpaccountlog_id_usagedefinition_fkey FOREIGN KEY (id_usagedefinition) REFERENCES acc_usagedefinition(id);


--
-- TOC entry 1955 (class 2606 OID 16639)
-- Dependencies: 1548 1550 1907
-- Name: acc_postporg_id_isporg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_ispsuborg
    ADD CONSTRAINT acc_postporg_id_isporg_fkey FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id);


--
-- TOC entry 1962 (class 2606 OID 16644)
-- Dependencies: 1903 1556 1546
-- Name: acc_prepaccount_id_accseries_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_prepaccount
    ADD CONSTRAINT acc_prepaccount_id_accseries_fkey FOREIGN KEY (id_accseries) REFERENCES acc_accseries(id);


--
-- TOC entry 1963 (class 2606 OID 16649)
-- Dependencies: 1548 1907 1556
-- Name: acc_prepaccount_id_isporg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_prepaccount
    ADD CONSTRAINT acc_prepaccount_id_isporg_fkey FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id);


--
-- TOC entry 1964 (class 2606 OID 16654)
-- Dependencies: 1556 1550 1909
-- Name: acc_prepaccount_id_ispsuborg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_prepaccount
    ADD CONSTRAINT acc_prepaccount_id_ispsuborg_fkey FOREIGN KEY (id_ispsuborg) REFERENCES acc_ispsuborg(id);


--
-- TOC entry 1965 (class 2606 OID 16659)
-- Dependencies: 1560 1923 1556
-- Name: acc_prepaccount_id_systemuser_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_prepaccount
    ADD CONSTRAINT acc_prepaccount_id_systemuser_fkey FOREIGN KEY (id_systemuser) REFERENCES acc_systemuser(id);


--
-- TOC entry 1966 (class 2606 OID 16664)
-- Dependencies: 1903 1546 1558
-- Name: acc_subscriberinfo_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_subscriberinfo
    ADD CONSTRAINT acc_subscriberinfo_fk FOREIGN KEY (id_accseries) REFERENCES acc_accseries(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 1967 (class 2606 OID 16669)
-- Dependencies: 1560 1907 1548
-- Name: acc_systemuser_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_systemuser
    ADD CONSTRAINT acc_systemuser_fk FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id) ON UPDATE CASCADE;


--
-- TOC entry 1968 (class 2606 OID 16674)
-- Dependencies: 1550 1560 1909
-- Name: acc_systemuser_id_ispsuborg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_systemuser
    ADD CONSTRAINT acc_systemuser_id_ispsuborg_fkey FOREIGN KEY (id_ispsuborg) REFERENCES acc_ispsuborg(id);


--
-- TOC entry 1969 (class 2606 OID 16679)
-- Dependencies: 1562 1907 1548
-- Name: acc_usagedefinition_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acc_usagedefinition
    ADD CONSTRAINT acc_usagedefinition_fk FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id) ON UPDATE CASCADE;


--
-- TOC entry 1970 (class 2606 OID 16684)
-- Dependencies: 1907 1548 1564
-- Name: nas_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY nas
    ADD CONSTRAINT nas_fk FOREIGN KEY (id_isporg) REFERENCES acc_isporg(id) ON UPDATE CASCADE;


--
-- TOC entry 1971 (class 2606 OID 16689)
-- Dependencies: 1909 1564 1550
-- Name: nas_pacc_id_ispsuborg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY nas
    ADD CONSTRAINT nas_pacc_id_ispsuborg_fkey FOREIGN KEY (id_ispsuborg) REFERENCES acc_ispsuborg(id);


--
-- TOC entry 1972 (class 2606 OID 16694)
-- Dependencies: 1546 1568 1903
-- Name: radcheck_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radcheck
    ADD CONSTRAINT radcheck_fk FOREIGN KEY (id_accseries) REFERENCES acc_accseries(id) ON UPDATE CASCADE;


--
-- TOC entry 1995 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2010-05-10 14:47:24 CEST

--
-- PostgreSQL database dump complete
--

