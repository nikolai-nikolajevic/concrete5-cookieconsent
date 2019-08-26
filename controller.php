<?php       

namespace Concrete\Package\Cookieconsent;

use Concrete\Core\Page\Single as SinglePage;
use Concrete\Core\Support\Facade\Config;
use Package;
use Loader;
use View;
use Route;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package
{
    protected $pkgHandle = 'cookieconsent';
	protected $appVersionRequired = '8.0.0';
    protected $pkgVersion = '1.0';

    protected $pkgAutoloaderRegistries = [
        'src/Cookieconsent' => '\Concrete\Package\Cookieconsent\Src\Cookieconsent',
    ];
    
    public function getPackageDescription()
	{
		return t("Cookieconsent");
	}

	public function getPackageName()
	{
		return t("Cookieconsent");
    }
    
    public function install()
	{
		$pkg = parent::install();
        SinglePage::add('/dashboard/cookieconsent', $pkg);
        
    }
    
    // Set Defaults
    public function setDefaults(){
        Config::save('cookieconsent.defaults', 1);
        Config::save('cookieconsent.popup-color', '#000000');
        Config::save('cookieconsent.button-color', '#ffaa00');
        Config::save('cookieconsent.layout', 'block');
        Config::save('cookieconsent.position', 'top');
        Config::save('cookieconsent.button-text', t('Got it!'));
        Config::save('cookieconsent.link-text', t('Learn more'));
        Config::save('cookieconsent.pageID', '');
        Config::save('cookieconsent.href', '');
        Config::save('cookieconsent.text', t('This website uses cookies to ensure you get the best experience on our website.'));
    }
    
    public function on_start()
    {
        Route::register('/cookieconsent/getData', '\Concrete\Package\Cookieconsent\Src\Cookieconsent\Helper::getData');
     
        if (Config::get('cookieconsent.defaults') != 1) {
            $this->setDefaults();
        }

        // Load magic only if cookie not exist
        if(!isset($_COOKIE['cookieconsent_status'])){
            View::getInstance()->addHeaderItem(Loader::helper('html')->css('/packages/cookieconsent/build/cookieconsent.min.css'));
            
            View::getInstance()->addFooterItem(Loader::helper('html')->javascript('/packages/cookieconsent/build/cookieconsent.min.js'));
            View::getInstance()->addFooterItem(Loader::helper('html')->javascript('/packages/cookieconsent/loadCooekieconsent.js'));
        }
    }

    public function uninstall()
    {
        Config::save('cookieconsent.defaults', null);
        parent::uninstall();
    }
}