<?php
require_once './Poll.php';

$poll = new Poll();
try {
    $poll->setVote($_GET['answer']);
} catch (Exception $e) {}

header('Location: index.php');