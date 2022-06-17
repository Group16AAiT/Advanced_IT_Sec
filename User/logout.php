<?php

require_once "../Manager/session.php";
ini_set("display_errors",1);
$sessionClass = new sessionClass();
$sessionClass->destorySession();
