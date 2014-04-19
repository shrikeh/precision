<?php
namespace Shrikeh\Precision;

use \Shrikeh\Precision\Calculator\Calculator;
use \Shrikeh\Precision\Calculator\Engine\Float;
use \Shrikeh\Precision\Calculator\Engine\Infinite;
use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\FunctorAggregate;
use \Shrikeh\Precision\Calculator\Engine\FunctorEngine;
use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\FunctorFactory\EngineFunctorFactory;

class Precision extends \Pimple
{
    public function __construct()
    {
        parent::__construct();

        $this['defaultScale'] = 2;

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
            return new Calculator(
                $c['numberFactory'],
                $c['engines'],
                $c['defaultScale']
            );
        };

        $this['engines'] = function($c) {
            return array(
                $c['engine:float'],
                $c['engine:infinite'],
            );
        };

        $this['engine:float'] = function($c) {
            $functorEngine = $c['functorEngine:float'];
            return function(Calculator $calculator) use ($functorEngine) {
                $factory = $calculator->getNumberFactory();
                return new Float($factory, $functorEngine);
            };
        };

        $this['engine:infinite'] = function($c) {
            $functorEngine = $c['functorEngine:infinite'];
            return function(Calculator $calculator) use ($functorEngine) {
                $factory = $calculator->getNumberFactory();
                return new Infinite($factory, $functorEngine);
            };
        };

        $this['functorEngine:float'] = function($c) {
            if (extension_loaded('bcmath')) {
                $functorFactory = $c['functorSuite:bcmath'];
            }
            return new FunctorAggregate($functorFactory);
        };

        $this['functorEngine:infinite'] = function($c) {
            $functorFactory = $c['functorSuite:infinite'];
            return new FunctorAggregate($functorFactory);
        };

        $this['functorSuite:infinite'] = function($c) {
            return new EngineFunctorFactory(array(
                FunctorEngine::MULTIPLY    => $c['infinite:multiply'],
                FunctorEngine::DIVIDE      => $c['infinite:divide'],
                FunctorEngine::ADD         => $c['infinite:add'],
                FunctorEngine::SUBTRACT    => $c['infinite:subtract'],
                FunctorEngine::ROUND       => $c['infinite:round'],
                FunctorEngine::MOD         => $c['infinite:mod'],
                FunctorEngine::COMPARE     => $c['infinite:compare'],
            ));
        };

        $this['functorSuite:bcmath'] = function($c) {
            return new EngineFunctorFactory(array(
                FunctorEngine::MULTIPLY    => $c['bcmath:multiply'],
                FunctorEngine::DIVIDE      => $c['bcmath:divide'],
                FunctorEngine::ADD         => $c['bcmath:add'],
                FunctorEngine::SUBTRACT    => $c['bcmath:subtract'],
                FunctorEngine::ROUND       => $c['bcmath:round'],
                FunctorEngine::MOD         => $c['bcmath:mod'],
                FunctorEngine::COMPARE     => $c['bcmath:compare'],
            ));
        };

        $this['infinite:add']           = '\Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\Infinite\Add';
        $this['infinite:subtract']      = '\Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\Infinite\Subtract';
        $this['infinite:multiply']      = '\Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\Infinite\Multiply';
        $this['infinite:divide']        = '\Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\Infinite\Divide';
        $this['infinite:round']         = '\Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\Infinite\Round';
        $this['infinite:mod']           = '\Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\Infinite\Mod';
        $this['infinite:compare']       = '\Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\Infinite\Compare';

        $this['bcmath:add']             = '\Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\BCMath\Add';
        $this['bcmath:subtract']        = '\Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\BCMath\Subtract';
        $this['bcmath:multiply']        = '\Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\BCMath\Multiply';
        $this['bcmath:divide']          = '\Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\BCMath\Divide';
        $this['bcmath:round']           = '\Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\BCMath\Round';
        $this['bcmath:mod']             = '\Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\BCMath\Mod';
        $this['bcmath:compare']         = '\Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\BCMath\Compare';
    }
}
