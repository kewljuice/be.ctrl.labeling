{*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.7                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2017                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 +--------------------------------------------------------------------+
*}
<div class="crm-block crm-form-block crm-contact-task-mailing-label-form-block">
    <div class="messages status no-popup">{include file="CRM/Contact/Form/Task.tpl"}</div>
    <div class="crm-submit-buttons">{include file="CRM/common/formButtons.tpl" location="top"}</div>
    <table class="form-layout-compressed">
        <tr class="crm-contact-task-mailing-label-form-block-label_name">
            <td class="label">{$form.label_name.label}</td>
            <td>{$form.label_name.html} {help id="id-select-label" file="CRM/Contact/Form/Task/Label.hlp"}</td>
        </tr>
        <tr class="crm-contact-task-mailing-label-form-block-template">
            <td class="label">{$form.template.label}</td>
            <td>{$form.template.html}</td>
        </tr>
    </table>
    <div class="crm-submit-buttons">{include file="CRM/common/formButtons.tpl" location="bottom"}</div>
</div>
