<?php

namespace Vlad\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VladUserBundle extends Bundle
{

	public function getParent()
	{
		return 'FOSUserBundle';
	}

}
