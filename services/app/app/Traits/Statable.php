<?php
/**
 * Created by PhpStorm.
 * User: roman_ushakov
 * Date: 2019-03-10
 * Time: 16:41
 */

namespace App\Traits;

use SM\Factory\FactoryInterface;
use SM\StateMachine\StateMachine;

trait Statable
{
    /**
     * @var StateMachine $stateMachine
     */
    protected $stateMachine;

    public function stateMachine()
    {
        if (!$this->stateMachine) {
            $this->stateMachine = app(FactoryInterface::class)->get($this, self::SM_CONFIG);
        }
        return $this->stateMachine;
    }

    public function stateIs()
    {
        return $this->stateMachine()->getState();
    }

    public function transition($transition)
    {
        return $this->stateMachine()->apply($transition);
    }

    public function transitionAllowed($transition)
    {
        return $this->stateMachine()->can($transition);
    }
}
