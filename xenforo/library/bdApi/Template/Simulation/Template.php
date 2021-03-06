<?php

class bdApi_Template_Simulation_Template extends XenForo_Template_Public
{
    public static $bdApi_visitor = null;
    public static $bdApi_mapping = array(
        'bb_code_tag_attach' => 'bdapi_bb_code_tag_attach',
    );

    public function clearRequiredExternalsForApi()
    {
        $this->_setRequiredExternals(array());
    }

    public function getRequiredExternalsAsHtmlForApi()
    {
        $required = $this->_getRequiredExternals();
        $html = '';
        foreach (array_keys($required) as $type) {
            $html .= $this->getRequiredExternalsAsHtml($type);
        }

        return $html;
    }

    public function getRequiredCssUrl(array $requirements)
    {
        $cssUrl = parent::getRequiredCssUrl($requirements);
        return XenForo_Link::convertUriToAbsoluteUri($cssUrl, true);
    }

    public function __construct($templateName, array $params = array())
    {
        if (isset(self::$bdApi_mapping[$templateName])) {
            $templateName = self::$bdApi_mapping[$templateName];
        }

        if (self::$bdApi_visitor !== null) {
            $params['visitor'] = self::$bdApi_visitor;
        }

        $languageId = 0;
        if (!empty($params['visitor']['language_id'])) {
            $languageId = $params['visitor']['language_id'];
        }
        if (empty($languageId)) {
            $languageId = XenForo_Application::getOptions()->get('defaultLanguageId');
        }

        $params['xenOptions'] = XenForo_Application::getOptions()->getOptions();

        parent::__construct(sprintf('__%s_%d', $templateName, $languageId), $params);
    }

    protected function _getTemplatesFromDataSource(array $templateList)
    {
        $db = XenForo_Application::getDb();

        $listByLanguageId = array();
        foreach ($templateList as $template) {
            if (preg_match('#^__(.+)_(\d+)$#', $template, $matches)) {
                $templateName = $matches[1];
                $languageId = $matches[2];

                if (!isset($listByLanguageId[$languageId])) {
                    $listByLanguageId[$languageId] = array();
                }
                $listByLanguageId[$languageId][] = $templateName;
            }
        }

        $results = array();

        foreach ($listByLanguageId as $languageId => $templateNames) {
            $templates = $db->fetchPairs('
				SELECT title, template_compiled
				FROM xf_template_compiled
				WHERE title IN (' . $db->quote($templateNames) . ')
					AND style_id = ?
					AND language_id = ?
			', array(
                XenForo_Application::getOptions()->get('defaultStyleId'),
                $languageId,
            ));

            foreach ($templates as $title => $compiled) {
                $results[sprintf('__%s_%d', $title, $languageId)] = $compiled;
            }
        }

        return $results;
    }

    protected function _loadTemplateFilePath($templateName)
    {
        if ($this->_usingTemplateFiles() AND preg_match('#^__(.+)_(\d+)$#', $templateName, $matches)) {
            $templateName = $matches[1];
            $styleId = XenForo_Application::getOptions()->get('defaultStyleId');
            $languageId = $matches[2];

            return XenForo_Template_FileHandler::get($templateName, $styleId, $languageId);
        } else {
            return '';
        }
    }

    protected function _processJsUrls(array $jsFiles)
    {
        $jsUrls = parent::_processJsUrls($jsFiles);

        foreach ($jsUrls as &$jsUrlRef) {
            $jsUrlRef = XenForo_Link::convertUriToAbsoluteUri($jsUrlRef, true);
        }

        return $jsUrls;
    }
}
