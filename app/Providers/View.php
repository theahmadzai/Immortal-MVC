<?php
namespace App\Providers;

class View
{
    public static function make($file, $data = [])
    {
        $loader = new \Twig_Loader_Filesystem(APP_ROOT . '/resources/views');
        $twig   = new \Twig_Environment($loader); //['cache' => APP_ROOT . '/cache',]

        $twig->addGlobal('ASSET_ROOT', ASSET_ROOT);

        try
        {
            if (is_null($data))
            {
                return $twig->render($file);
            }

            echo $twig->render($file, $data);
        }
        catch (Twig_Error_Loader $e)
        {
            return $this->getErrorMessage('loader', $e->getMessage());
        }
        catch (Twig_Error_Runtime $e)
        {
            return $this->getErrorMessage('runtime', $e->getMessage());
        }
        catch (Twig_Error_Syntax $e)
        {
            return $this->getErrorMessage('syntax', $e->getMessage());
        }
    }

    private function getErrorMessage($errorType, $errorMessage)
    {
        return sprintf("A %s error occured: %s", $errorType, $errorMessage);
    }
}
