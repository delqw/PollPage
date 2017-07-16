<?php

class Poll {

    private $filename = __DIR__.'/poll.json';
    private $votes;
    private $question;
    private $total;

    public function __construct() {
        if (!file_exists($this->filename)) throw new Exception('File not found');
        $data = json_decode(file_get_contents($this->filename), true);
        $this->total = $data['total'];
        $this->question = $data['question'];
        $this->votes = $data['votes'];
    }

    private function save() {
        $data = [
            'question' => $this->question,
            'votes' => $this->votes,
            'total' => $this->total
        ];
        return !!file_put_contents($this->filename, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function getQuestion() {
        return $this->question;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getVotes() {
        return $this->votes;
    }

    public function setVote($variant) {
        if (!isset($this->votes[$variant])) throw new Exception('Bad variant');
        $this->votes[$variant]['value']++;
        $this->total++;
        $this->calculatePercentage();
        return $this->save();
    }

    private function calculatePercentage() {
        foreach ($this->votes as $key => $vote) {
            $this->votes[$key]['percent'] = round(100 * $vote['value'] / $this->total, 2);
        }
    }
}