<?php
namespace Concrete\Package\Cookieconsent\Controller\SinglePage\Dashboard;

use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Support\Facade\Config;

class Cookieconsent extends DashboardPageController
{
    public function save() 
    {
        $args = $this->request->request->all();

        Config::save('cookieconsent.popup-color', $args['popup-color']);
        Config::save('cookieconsent.button-color', $args['button-color']);
        Config::save('cookieconsent.layout', $args['layout']);

        if ($args['position'] == 'top-static') {
            Config::save('cookieconsent.position', 'top');
            Config::save('cookieconsent.static', true);
        } else {
            Config::save('cookieconsent.position', $args['position']);
            Config::save('cookieconsent.static', false);
        }
        
        Config::save('cookieconsent.text', $args['text']);
        Config::save('cookieconsent.button-text', $args['button-text']);
        Config::save('cookieconsent.link-text', $args['link-text']);
        Config::save('cookieconsent.pageID', $args['pageID']);
        Config::save('cookieconsent.href', $args['href']);
    }
}
