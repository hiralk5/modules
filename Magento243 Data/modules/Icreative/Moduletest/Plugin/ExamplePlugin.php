<?php

namespace Icreative\Moduletest\Plugin;

class ExamplePlugin{

	public function beforeSetTitle(\Icreative\Moduletest\Controller\Index\Example $subject, $title)
		{
			$title = $title . " to you </br>";
			echo __METHOD__ . "</br>";

			return [$title];
		}
	public function afterGetTitle(\Icreative\Moduletest\Controller\Index\Example $subject, $result)
	{

		echo __METHOD__ . "</br>";

		return '<h1>'. $result . 'Example.com' .'</h1>';

	}
	public function aroundGetTitle(\Icreative\Moduletest\Controller\Index\Example $subject, callable $proceed)
	{

		echo __METHOD__ . " - Before proceed() </br>";
		 $result = $proceed();
		echo __METHOD__ . " - After proceed() </br>";


		return $result;
	}

}
