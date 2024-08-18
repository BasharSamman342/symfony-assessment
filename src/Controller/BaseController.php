<?php

namespace App\Controller;

use App\Traits\HttpResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    use HttpResponse;    
}
