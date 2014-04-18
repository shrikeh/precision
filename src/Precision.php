<?php
namespace Shrikeh\Precision;

use \Shrikeh\Precision\Calculator\Calculator;
use \Shrikeh\Precision\Calculator\Engine\Float;
use \Shrikeh\Precision\Calculator\Engine\Infinite;
use \Shrikeh\Precision\Calculator\Engine\FunctorFactory;

class Precision extends \Pimple
{
    public function __construct()
    {
        parent::__construct();

        $this['numberFactory'] = function($c) {
            $numberClasses = $c['numberFactory:classes'];
            return function() use ($numberClasses) {
                return new NumberFactory($this, $numberClasses);
            };
        };

        $this['numberFactory:classes'] = array(
            '\Shrikeh\Precision\Number\Zero',
            '\Shrikeh\Precision\Number\Infinity',
            '\Shrikeh\Precision\Number\FloatingPoint',
            '\Shrikeh\Precision\Number\NotANumber',
        );

        $this['calculator'] = function($c) {
            return new Calculator($c['numberFactory'], $c['engines']);
        };

        $this['engines'] = function($c) {
            return array(
                //$c['engine:integer'],
                $c['engine:infinite'],
                $c['engine:float'],
            );
        };

        $this['engine:infinite'] = function($c) {
            $functorFactory = $c['functorsuite:infinite'];
            return new Infinite($functorFactory);
        };

        $this['engine:float'] = function($c) {
            if (extension_loaded('bcmath')) {
                $functorFactory = $c['functorsuite:bcmath'];
            }
            return new Float($functorFactory);
        };

        $this['functorsuite:infinite'] = function($c) {
            return new FunctorFactory\EngineFunctorFactory(array(
                FunctorFactory::MULTIPLY    => $c['infinite:multiply'],
                FunctorFactory::DIVIDE      => $c['infinite:divide'],
                FunctorFactory::ADD         => $c['infinite:add'],
                FunctorFactory::SUBTRACT    => $c['infinite:subtract'],
                FunctorFactory::ROUND       => $c['infinite:round'],
                FunctorFactory::MOD         => $c['infinite:mod'],
                FunctorFactory::COMPARE     => $c['infinite:compare'],
            ));
        };

        $this['functorsuite:bcmath'] = function($c) {
            return new FunctorFactory\EngineFunctorFactory(array(
                FunctorFactory::MULTIPLY    => $c['bcmath:multiply'],
                FunctorFactory::DIVIDE      => $c['bcmath:divide'],
                FunctorFactory::ADD         => $c['bcmath:add'],
                FunctorFactory::SUBTRACT    => $c['bcmath:subtract'],
                FunctorFactory::ROUND       => $c['bcmath:round'],
                FunctorFactory::MOD         => $c['bcmath:mod'],
                FunctorFactory::COMPARE     => $c['bcmath:compare'],
            ));
        };

        $this['infinite:add']           = '\Shrikeh\Precision\Calculator\Engine\Infinite\Add';
        $this['infinite:subtract']      = '\Shrikeh\Precision\Calculator\Engine\Infinite\Subtract';
        $this['infinite:multiply']      = '\Shrikeh\Precision\Calculator\Engine\Infinite\Multiply';
        $this['infinite:divide']        = '\Shrikeh\Precision\Calculator\Engine\Infinite\Divide';
        $this['infinite:round']         = '\Shrikeh\Precision\Calculator\Engine\Infinite\Round';
        $this['infinite:mod']           = '\Shrikeh\Precision\Calculator\Engine\Infinite\Mod';
        $this['infinite:compare']       = '\Shrikeh\Precision\Calculator\Engine\Infinite\Compare';

        $this['bcmath:add']             = '\Shrikeh\Precision\Calculator\Engine\BCMath\Add';
        $this['bcmath:subtract']        = '\Shrikeh\Precision\Calculator\Engine\BCMath\Subtract';
        $this['bcmath:multiply']        = '\Shrikeh\Precision\Calculator\Engine\BCMath\Multiply';
        $this['bcmath:divide']          = '\Shrikeh\Precision\Calculator\Engine\BCMath\Divide';
        $this['bcmath:round']           = '\Shrikeh\Precision\Calculator\Engine\BCMath\Round';
        $this['bcmath:mod']             = '\Shrikeh\Precision\Calculator\Engine\BCMath\Mod';
        $this['bcmath:compare']         = '\Shrikeh\Precision\Calculator\Engine\BCMath\Compare';
    }
}
