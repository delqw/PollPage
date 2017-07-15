<?php

require_once './Poll.php';

$poll = new Poll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Poll</title>
    <link href="./static/bootstrap.min.css" rel="stylesheet">
    <link href="./static/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1><?=$poll->getQuestion()?></h1>
                    <?php foreach ($poll->getVotes() as $name => $vote) {
                        echo $name.' ('.$vote['value'].') <a href="vote.php?answer='.urldecode($name).'">Vote</a>';
                        echo '<div class="progress"><div class="progress-bar" role="progressbar" style="width: '
                            .$vote['percent'].'%;">'.($vote['percent'] > 0 ? $vote['percent'].'%' : '').'</div></div>';
                    }?>
                    <div>Total: <?=$poll->getTotal()?></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
