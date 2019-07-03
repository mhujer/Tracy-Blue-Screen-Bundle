<?php

declare(strict_types = 1);

namespace VasekPurchart\TracyBlueScreenBundle\BlueScreen;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Tracy\BlueScreen;

class ControllerBlueScreenExceptionListenerTest extends \PHPUnit\Framework\TestCase
{

	public function testRenderTracy(): void
	{
		$kernel = $this->createMock(HttpKernelInterface::class);
		$request = new Request();
		$requestType = HttpKernelInterface::MASTER_REQUEST;
		$exception = new \Exception('Foobar!');

		$event = new ExceptionEvent($kernel, $request, $requestType, $exception);

		$blueScreen = $this->createMock(BlueScreen::class);
		$blueScreen
			->expects($this->once())
			->method('render')
			->with($exception);

		$listener = new ControllerBlueScreenExceptionListener($blueScreen);
		$listener->onKernelException($event);
	}

}
