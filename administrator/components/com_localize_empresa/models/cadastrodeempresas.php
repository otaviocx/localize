<?php

/**
 * @version     1.0.0
 * @package     com_localize_empresa
 * @copyright   Copyright (C) 2015. Todos os direitos reservados.
 * @license     GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 * @author      Victor Bento <vgb.info@gmail.com> - http://victorbento.com.br
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Localize_empresa records.
 */
class Localize_empresaModelCadastrodeempresas extends JModelList {

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                                'id', 'a.`id`',
                'ordering', 'a.`ordering`',
                'state', 'a.`state`',
                'created_by', 'a.`created_by`',
                'modified_by', 'a.`modified_by`',
                'updated', 'a.`updated`',
                'nome', 'a.`nome`',
                'cnpj', 'a.`cnpj`',
                'logo', 'a.`logo`',
                'fundacao', 'a.`fundacao`',
                'sobre', 'a.`sobre`',
                'link', 'a.`link`',
                'telefone1', 'a.`telefone1`',
                'telefone2', 'a.`telefone2`',
                'email', 'a.`email`',
                'corretores', 'a.`corretores`',

            );
        }

        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     */
    protected function populateState($ordering = null, $direction = null) {
        // Initialise variables.
        $app = JFactory::getApplication('administrator');

        // Load the filter state.
        $search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        $published = $app->getUserStateFromRequest($this->context . '.filter.state', 'filter_published', '', 'string');
        $this->setState('filter.state', $published);

        
		//Filtering corretores
		$this->setState('filter.corretores', $app->getUserStateFromRequest($this->context.'.filter.corretores', 'filter_corretores', '', 'string'));


        // Load the parameters.
        $params = JComponentHelper::getParams('com_localize_empresa');
        $this->setState('params', $params);

        // List state information.
        parent::populateState('a.nome', 'asc');
    }

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param	string		$id	A prefix for the store id.
     * @return	string		A store id.
     * @since	1.6
     */
    protected function getStoreId($id = '') {
        // Compile the store id.
        $id.= ':' . $this->getState('filter.search');
        $id.= ':' . $this->getState('filter.state');

        return parent::getStoreId($id);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery() {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
                $this->getState(
                        'list.select', 'DISTINCT a.*'
                )
        );
        $query->from('`#__localize_empresa` AS a');

        
		// Join over the users for the checked out user
		$query->select("uc.name AS editor");
		$query->join("LEFT", "#__users AS uc ON uc.id=a.checked_out");
		// Join over the user field 'created_by'
		$query->select('`created_by`.name AS `created_by`');
		$query->join('LEFT', '#__users AS `created_by` ON `created_by`.id = a.`created_by`');
		// Join over the user field 'modified_by'
		$query->select('`modified_by`.name AS `modified_by`');
		$query->join('LEFT', '#__users AS `modified_by` ON `modified_by`.id = a.`modified_by`');
		// Join over the user field 'corretores'
		$query->select('`corretores`.name AS `corretores`');
		$query->join('LEFT', '#__users AS `corretores` ON `corretores`.id = a.`corretores`');

        

		// Filter by published state
		$published = $this->getState('filter.state');
		if (is_numeric($published)) {
			$query->where('a.state = ' . (int) $published);
		} else if ($published === '') {
			$query->where('(a.state IN (0, 1))');
		}

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int) substr($search, 3));
            } else {
                $search = $db->Quote('%' . $db->escape($search, true) . '%');
                $query->where('( a.`nome` LIKE '.$search.'  OR  a.`cnpj` LIKE '.$search.'  OR  a.`telefone1` LIKE '.$search.'  OR  a.`email` LIKE '.$search.'  OR  a.`corretores` LIKE '.$search.' )');
            }
        }

        

		//Filtering corretores
		$filter_corretores = $this->state->get("filter.corretores");
		if ($filter_corretores) {
			$query->where("a.`corretores` = '".$db->escape($filter_corretores)."'");
		}


        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        if ($orderCol && $orderDirn) {
            $query->order($db->escape($orderCol . ' ' . $orderDirn));
        }

        return $query;
    }

    public function getItems() {
        $items = parent::getItems();
        
        return $items;
    }

}
