<?php

require_once __DIR__.'/Poll.php';

$poll = new Poll();

if (isset($_GET['answer'])) {
    try {
        $poll->setVote($_GET['answer']);
    } catch (Exception $e) {}
    header('Location: '.$_SERVER['HTTP_REFERER']);
}

$template = '<div class="panel panel-default">';
$template .= '<div class="panel-body">';
$template .= '<h1>'.$poll->getQuestion().'</h1>';
foreach ($poll->getVotes() as $name => $vote) {
    $template .= $name.' ('.$vote['value'].') <a href="?answer='.urldecode($name).'">Vote</a>';
    $template .= '<div class="progress"><div class="progress-bar" role="progressbar" style="width: '
        .$vote['percent'].'%;">'.($vote['percent'] > 0 ? $vote['percent'].'%' : '').'</div></div>';

}
$template .= '<div>Total: '.$poll->getTotal().'</div>';
$template .= '</div>';
$template .= '</div>';