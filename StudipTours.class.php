<?php

require_once dirname(__file__)."/classes/JoyrideTours.class.php";

class StudipTours extends StudIPPlugin implements SystemPlugin {
    
    public function __construct() {
        parent::__construct();
        if ($GLOBALS['user']->id !== "nobody") {
            $tour = $this->getTour();
            if ($tour) {
                $this->initTour($tour);
                $tourstarter = new Navigation(_("Tour"));
                $tourstarter->setURL("#");
                Navigation::insertItem("/links/tour", $tourstarter, "logout");
            }
        }
    }
    
    protected function getTour() {
        $script = $GLOBALS['i_page'].$_SERVER['PATH_INFO'];
        $folder_path = dirname(__file__)."/tours";
        $tours_folder = opendir($folder_path);
        while (($file = readdir($tours_folder)) !== false) {
            if (!is_dir($folder_path."/".$file)
                    && strpos($file, ".") !== 0
                    && strpos($file, ".php") !== false) {
                $file2script = str_replace("__", "/", $file);
                $file2script = substr($file2script, 0, strlen($file2script) - 4);
                if (stripos($script, $file2script) === 0) {
                    //Bingo!
                    closedir($tours_folder);
                    return $file;
                }
            }
        }
        closedir($tours_folder);
        return false;
    }
    
    protected function initTour($file) {
        $script = str_replace("__", "/", $file);
        $script = substr($script, 0, strlen($script) - 4);
        $tour_done = JoyrideTours::getByScript($script);
        
        PageLayout::addHeadElement("link", array('rel' => "stylesheet", 'href' => $this->getPluginURL()."/assets/joyride-2.0.3.css"));
        PageLayout::addHeadElement("script", array('type' => "text/javascript", 'src' => $this->getPluginURL()."/assets/jquery.cookie.js"), "");
        PageLayout::addHeadElement("script", array('type' => "text/javascript", 'src' => $this->getPluginURL()."/assets/jquery.joyride-2.0.3.js"), "");
        PageLayout::addHeadElement("script", array('type' => "text/javascript", 'src' => $this->getPluginURL()."/assets/studip_tours.js"), "");
        $tour = $this->getTourTemplate($file, null)
                        ->render();
        PageLayout::addBodyElements($tour);
        if ($tour_done->isNew()) {
            PageLayout::addHeadElement("script", array('type' => "text/javascript"), "jQuery(STUDIP.tours.start);");
        }
    }
    
    protected function getTourTemplate($template_file_name) {
        if (!$this->template_factory) {
            $this->template_factory = new Flexi_TemplateFactory(dirname(__file__)."/tours");
        }
        $template = $this->template_factory->open($template_file_name);
        return $template;
    }
    
    public function skip_action() {
        if ($GLOBALS["user"]->id !== "nobody" && Request::get("script") && Request::isPost()) {
            $tour = JoyrideTours::getByScript(Request::get("script"));
            $tour->store();
        }
    }
    
}