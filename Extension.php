<?php

namespace Bolt\Extension\Bobdenotter\Editbutton;

use Bolt\Application;
use Bolt\BaseExtension;

class Extension extends BaseExtension
{


    public function initialize() {
        $this->addSnippet('endofbody', 'editButtonCode');
    }

    public function getName()
    {
        return "Quick Edit Button";
    }

    public function editButtonCode()
    {
        // Take height of debug bar into account..
        if ($this->app['config']->get('general/debug')) {
            $bottom = 50;
        } else {
            $bottom = 20;
        }

        switch ($this->config['button_location']) {
            case 'topright':
                $position = 'right: 10px; top: 20px;';
                break;
            case 'bottomleft':
                $position = 'left: 10px; bottom: ' . $bottom . 'px;';
                break;
            case 'bottomright':
                $position = 'right: 10px; bottom: ' . $bottom . 'px;';
                break;
            case 'topleft':
            default:
                $position = 'left: 10px; top: 20px;';
        }

        $this->app['twig.loader.filesystem']->addPath(__DIR__);
        $html = $this->app['render']->render(
                "assets/editbutton.twig",
                array('position' => $position, 'config' => $this->config)
            );

        return $html;
    }


}






