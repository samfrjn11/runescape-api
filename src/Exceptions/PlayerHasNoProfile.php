<?php

declare(strict_types=1);

namespace RuneStat\Exceptions;

class PlayerHasNoProfile extends Base
{
    public function __construct(string $rsn)
    {
        parent::__construct(
            sprintf('Player [%s] has no profile', $rsn)
        );
    }
}
