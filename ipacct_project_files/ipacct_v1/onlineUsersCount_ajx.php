<?php

/*
Generated By PHP Konsole
on primus [Apache/2.0.52 (Fedora)]
at Fri, 26 May 2006 10:39:58 +0200
*/

require_once('framework.php');

$mess = new cMessage('en','onlineUsers');

$nrusers=$mess->getSession('numonlineusers');
echo NRUSER.' '.$nrusers;

?>