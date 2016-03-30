<?php

namespace Bolt\Extension\Bobdenotter\EditButton;

use Bolt\Asset\Snippet\Snippet;
use Bolt\Asset\Target;
use Bolt\Extension\SimpleExtension;

class EditButtonExtension extends SimpleExtension
{
    protected function registerAssets()
    {
        $asset = new Snippet();
        $asset->setCallback([$this, 'editButtonCode'])
            ->setLocation(Target::END_OF_BODY)
            ->setPriority(99)
        ;

        // Add some web assets from the web/ directory
        return [ $asset ];
    }

    public function editButtonCode()
    {
        $app = $this->getContainer();
        $config = $this->getConfig();

        // Take height of debug bar into account..
        if ($app['config']->get('general/debug')) {
            $bottom = 50;
        } else {
            $bottom = 20;
        }

        switch ($config['button_location']) {
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

        $html = $this->renderTemplate(
                "editbutton.twig",
                array('position' => $position, 'config' => $config)
            );

        return $html;
    }
}






