<?php
/**
 * @version     1.0.0
 * @package     com_localize_empresa
 * @copyright   Copyright (C) 2015. Todos os direitos reservados.
 * @license     GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 * @author      Victor Bento <vgb.info@gmail.com> - http://victorbento.com.br
 */
// no direct access
defined('_JEXEC') or die;

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_localize_empresa.' . $this->item->id);
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_localize_empresa' . $this->item->id)) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>
<?php if ($this->item) : ?>

    <div class="item_fields">
        <table class="table">
            <tr>
			<th><?php echo JText::_('COM_LOCALIZE_EMPRESA_FORM_LBL_CADASTRODEEMPRESA_ID'); ?></th>
			<td><?php echo $this->item->id; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_LOCALIZE_EMPRESA_FORM_LBL_CADASTRODEEMPRESA_STATE'); ?></th>
			<td>
			<i class="icon-<?php echo ($this->item->state == 1) ? 'publish' : 'unpublish'; ?>"></i></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_LOCALIZE_EMPRESA_FORM_LBL_CADASTRODEEMPRESA_CREATED_BY'); ?></th>
			<td><?php echo $this->item->created_by_name; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_LOCALIZE_EMPRESA_FORM_LBL_CADASTRODEEMPRESA_MODIFIED_BY'); ?></th>
			<td><?php echo $this->item->modified_by_name; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_LOCALIZE_EMPRESA_FORM_LBL_CADASTRODEEMPRESA_UPDATED'); ?></th>
			<td><?php echo $this->item->updated; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_LOCALIZE_EMPRESA_FORM_LBL_CADASTRODEEMPRESA_NOME'); ?></th>
			<td><?php echo $this->item->nome; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_LOCALIZE_EMPRESA_FORM_LBL_CADASTRODEEMPRESA_CNPJ'); ?></th>
			<td><?php echo $this->item->cnpj; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_LOCALIZE_EMPRESA_FORM_LBL_CADASTRODEEMPRESA_LOGO'); ?></th>
			<td><?php echo $this->item->logo; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_LOCALIZE_EMPRESA_FORM_LBL_CADASTRODEEMPRESA_FUNDACAO'); ?></th>
			<td><?php echo $this->item->fundacao; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_LOCALIZE_EMPRESA_FORM_LBL_CADASTRODEEMPRESA_SOBRE'); ?></th>
			<td><?php echo $this->item->sobre; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_LOCALIZE_EMPRESA_FORM_LBL_CADASTRODEEMPRESA_LINK'); ?></th>
			<td><?php echo $this->item->link; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_LOCALIZE_EMPRESA_FORM_LBL_CADASTRODEEMPRESA_TELEFONE1'); ?></th>
			<td><?php echo $this->item->telefone1; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_LOCALIZE_EMPRESA_FORM_LBL_CADASTRODEEMPRESA_TELEFONE2'); ?></th>
			<td><?php echo $this->item->telefone2; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_LOCALIZE_EMPRESA_FORM_LBL_CADASTRODEEMPRESA_EMAIL'); ?></th>
			<td><?php echo $this->item->email; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_LOCALIZE_EMPRESA_FORM_LBL_CADASTRODEEMPRESA_CORRETORES'); ?></th>
			<td><?php echo $this->item->corretores_name; ?></td>
</tr>

        </table>
    </div>
    <?php if($canEdit && $this->item->checked_out == 0): ?>
		<a class="btn" href="<?php echo JRoute::_('index.php?option=com_localize_empresa&task=cadastrodeempresa.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_LOCALIZE_EMPRESA_EDIT_ITEM"); ?></a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_localize_empresa.cadastrodeempresa.'.$this->item->id)):?>
									<a class="btn" href="<?php echo JRoute::_('index.php?option=com_localize_empresa&task=cadastrodeempresa.remove&id=' . $this->item->id, false, 2); ?>"><?php echo JText::_("COM_LOCALIZE_EMPRESA_DELETE_ITEM"); ?></a>
								<?php endif; ?>
    <?php
else:
    echo JText::_('COM_LOCALIZE_EMPRESA_ITEM_NOT_LOADED');
endif;
?>
