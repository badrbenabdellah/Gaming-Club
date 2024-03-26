<!-- fichier db-config.php -->
<?php
$DB_DSN = 'pgsql:host=localhost;dbname=gaming_club_db;port=5432';
$DB_USER = 'postgres';
$DB_PASS = 'Sangareba1@';
$DB_OP = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
];


/*
*/