<?php
namespace Concrete\Package\Cookieconsent\Src\Cookieconsent;
use Concrete\Core\Controller\Controller;
use Config;
use Page;

class Helper extends Controller
{
    public function getData()
    {
        $args = Config::get('cookieconsent');

        $args['href'] = Page::getByID($args['pageID'])->getCollectionLink();
        
        echo json_encode($args);
    }
}
