<?php

/**
 * @version     1.0.0
 * @package     com_localize_empresa
 * @copyright   Copyright (C) 2015. Todos os direitos reservados.
 * @license     GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 * @author      Victor Bento <vgb.info@gmail.com> - http://victorbento.com.br
 */
defined('_JEXEC') or die;

class Localize_empresaFrontendHelper
{
	

	/**
	 * Get an instance of the named model
	 *
	 * @param string $name
	 *
	 * @return null|object
	 */
	public static function getModel($name)
	{
		$model = null;

		// If the file exists, let's
		if (file_exists(JPATH_SITE . '/components/com_localize_empresa/models/' . strtolower($name) . '.php'))
		{
			require_once JPATH_SITE . '/components/com_localize_empresa/models/' . strtolower($name) . '.php';
			$model = JModelLegacy::getInstance($name, 'Localize_empresaModel');
		}

		return $model;
	}
}
