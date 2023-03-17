<?php
namespace app\core\exceptions;

use Exception;

class NotFoundException extends Exception
{
  protected $message = "Page Not found";
  protected $code = 404;
}