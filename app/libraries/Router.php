<?php
/**
 * Copyright (c) 2017 AvikB, some rights reserved.
 *  Copyright under Creative Commons Attribution-ShareAlike 3.0 Unported,
 *  for details visit: https://creativecommons.org/licenses/by-sa/3.0/
 *
 * @Contributors:
 * Created by AvikB for noncommercial MusicBee project.
 *  Spelling mistakes and fixes from community members.
 *
 */

/**
 * Created by PhpStorm.
 * User: Avik
 * Date: 19-01-2017
 * Time: 03:31 AM
 */

namespace App\Lib\Utility;

use App\Lib\Controller;
use App\Lib\Model;
use App\Lib\Utility\Route;
use App\Lib\View;


class Router
{
    protected $urlParamArray;


    /**
     * Creates MVC based on the route
     *
     * @return bool
     */
    public function route()
    {
        $urlGetParam = trim($this->getUrlWithoutLanguageParam(), "/");
        $this->urlParamArray = explode("/", $urlGetParam);
        $routeArray = getRoutes();

        foreach ($routeArray as $route) {
            $url = '/'.$urlGetParam;
            if ($url == $route['url']) {
                //validate controller
                $route['controller'] = isset($route['controller'])?
                                            $route['controller'] :null;
                $route['model']      = isset($route['model'])? $route['model']: null;
                $this->createMVC(
                    $route['model'], $route['view'], $route['controller']
                );
                return true;
            }
            //todo: add call_user_func if no MVC is found!
        }
        $this->loadErrorPage();
        return false;
    }


    /**
     * Create the requested view and controller. the controller will
     * instantiate the model and pass it on to the view
     *
     * @param string|null $model
     * @param string|null $view
     * @param string|null $controller
     */
    public function createMVC(
        $model = null, $view = null, $controller = null
    ) {
        //if model and controller is not defined that most likely it is a static page
        if ($view == null) {
            die("MVC is not defined properly!");
        }

        //Define the namespaces for MVC
        $modelNamespace = "App\\Lib\\Model\\{$model}";
        $controllerNamespace = "App\\Controllers\\{$controller}";
        $viewNamespace = "App\\View\\{$view}";

        $model = (class_exists($modelNamespace))
            ? new $modelNamespace()
            : null;
        $controller = (class_exists($controllerNamespace) && $model != null)
            ? new $controllerNamespace($model)
            : null;

        if (class_exists($viewNamespace)) {
            $newView = $this->_createView($viewNamespace, $model);
            $newView->render();
        } else {
            $this->loadErrorPage();
        }
    }


    /**
     * Create View
     *
     * @param string $namespace
     * @param Model $model
     * @return View
     */
    private function _createView(string $namespace, Model $model) : View
    {
        return new $namespace($model);
    }

    /**
     * Loads the 404 error page
     *
     * @return null
     */
    public function loadErrorPage()
    {
        var_dump("404 Error");
    }


    /**
     * Get language code from url parameter
     *
     * @return null|string
     */
    public function getLanguageParamFromUrl()
    {
        if (isset($_GET['param'])) {
            return explode("/", $_GET['param'])[0];
        }

        return null;
    }

    /**
     * Get all parameter from url
     *
     * @return array|null
     */
    public function getParamFromUrl()
    {
        if (isset($_GET['param'])) {
            return explode("/", $_GET['param']);
        }

        return null;
    }


    /**
     *  Generate url with language code. eg: getmusicbee.com/en_us/param...
     *
     * @param $locale
     * @param $defaultLaguageReq
     * @return mixed|null
     */
    public function generateUrlWithLangParam($locale, $defaultLaguageReq)
    {
        if ($locale == null) {
            return null;
        }
        $locale = strtolower($locale);
        $defaultLaguageReq = strtolower($defaultLaguageReq);
        $urlParam = $this->getParamFromUrl();
        if ($urlParam != null) {
            if ($defaultLaguageReq != "") {
                $urlParam[0] = $defaultLaguageReq;
            } else {
                array_unshift($urlParam, $locale);
            }
        } else {
            $urlParam[0] = $locale;
        }

        return filter_var(implode("/", $urlParam), FILTER_SANITIZE_URL);
    }

    /**
     * Get the url without language codes such as: en_us, ru_ru etc
     *
     * @return string
     */
    public function getUrlWithoutLanguageParam()
    {
        $urlGetParamArray = self::getParamFromUrl();
        if (is_array($urlGetParamArray)) {
            unset($urlGetParamArray[0]);
        }

        if (null == $urlGetParamArray) {
            return "/";
        }

        return implode("/", $urlGetParamArray);
    }
}
