<?php
namespace app\core\exceptions;

use Exception;

class ForbbidenException extends Exception
{
  protected $message = "You don't have permission to access.";
  protected $code = 403;
}