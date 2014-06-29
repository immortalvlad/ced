<?php
class DuelBadgeActivator extends BadgeActivator
{
    public function triggerDuelFirstWin($role, $winner)
    {
        if ($role == 'caller' and $winner == 'caller') {
            $this->activate('first_duel_win');
        }
    }

    public function triggerDuelSuccess($cnt)
    {
        if ($cnt >= 100) {
            $this->activate('duel_success_100');
        }
    }

    public function triggerDuelFail($cnt)
    {
        if ($cnt >= 100) {
            $this->activate('duel_fail_100');
        }
    }

    public function triggerDuelRate($cntSuccess, $cntFail)
    {
        $mapMax = [
            ['limit'=>100, 'percent'=>40],
            ['limit'=>300, 'percent'=>25],
            ['limit'=>600, 'percent'=>10],
            ];
        foreach ($mapMax as $params) {
            if ($this->getSuccessRate($params['limit'], $cntSuccess, $cntFail) <= $params['percent']) {
                $this->activate('duel_rate_' . $params['percent']);
            }
        }

        $mapMin = [
            ['limit'=>100, 'percent'=>60],
            ['limit'=>300, 'percent'=>75],
            ['limit'=>900, 'percent'=>90],
            ];
        foreach ($mapMin as $params) {
            if ($this->getSuccessRate($params['limit'], $cntSuccess, $cntFail) >= $params['percent']) {
                $this->activate('duel_rate_' . $params['percent']);
            }
        }
    }

    public function triggerDuelMoney($dollar)
    {
        foreach ([100, 1000] as $limit) {
            if ($dollar >= $limit) {
                $this->activate('duel_money_' . $limit);
            }
        }
    }

    public function triggerDuelWinChance($isWinner, $chance)
    {
        if (!$isWinner) {
            return false;
        }

        foreach ([35, 20, 5] as $limit) {
            if ($chance <= $limit) {
                $this->activate('duel_win_chance' . $limit);
            }
        }
    }

    public function triggerDuelLoseChance($isWinner, $chance)
    {
        if ($isWinner) {
            return false;
        }

        foreach ([65, 80, 95] as $limit) {
            if ($chance >= $limit) {
                $this->activate('duel_lose_chance' . $limit);
            }
        }
    }

    public function triggerDuel2h($role)
    {
        if ($role == 'caller' and date('G') == 2) {
            $this->activate('duel_2h');
        }
    }

    private function getSuccessRate($limit, $cntSuccess, $cntFail)
    {
        $rate = 50;
        if ($cntSuccess + $cntFail >= $limit) {
            $rate = round($cntSuccess / (($cntSuccess + $cntFail)/100), 1);
        }
        return $rate;
    }
}
