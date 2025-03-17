<?php
require_once './classes/SessionManager.php';

session_start();
header('Content-Type: application/json');

SessionManager::getUsername();