define([
'Magento_Ui/js/grid/columns/column',
'jquery',
'text!ui/template/modal/modal-popup.html',
'mage/template',
'mage/validation',
'text!Popup_Shipinvoice/templates/grid/cells/sendemail/sendemail.html',
'Magento_Ui/js/modal/modal',
'Magento/Sales/Block/Order/PrintOrder/Invoice'
], function (Column, $,popupTpl, mageTemplate, validation, sendmailPreviewTemplate) {
'use strict';

  return Column.extend({
    defaults: {
    bodyTmpl: 'ui/grid/cells/html',
    fieldClass: {
      'data-grid-html-cell': true
    }
  },
  gethtml: function (row) { return row[this.index + '_html']; },
  getFormaction: function (row) { return row[this.index + '_formaction']; },
  getFormkey: function (row) { return row[this.index + '_formkry']; },
  getEntityid: function (row) { return row[this.index + '_entity_id']; },
  getLabel: function (row) { return row[this.index + '_html'] },
  getTitle: function (row) { return row[this.index + '_title'] },
  // getCode: function (row) { return row[this.index + '_code'] },
  /*getLinkOne: function (row) { return row[this.index + '_link_one'] },
  getLinkTwo: function (row) { return row[this.index + '_link_one'] },*/

  preview: function (row) {
 /*var modalHtml = mageTemplate(
   sendmailPreviewTemplate,
   {
     html: this.gethtml(row),
     title: this.getTitle(row),
     label: this.getLabel(row),
     formaction: this.getFormaction(row),
     // formakey: this.getFormkey(row),
     // code: this.getCode(row),
    /* linkTwo: this.getLinkTwo(row),
     linkOne: this.getLinkOne(row),*/
     // entityid: this.getEntityid(row),
     /*name: $.mage.__('Name'),
     email: $.mage.__('Email'),
     message: $.mage.__('Comment'),
     selectlink: $.mage.__('Please select'),
     demo1option: $.mage.__('demo1'),
     demo2option: $.mage.__('demo2')*/
   /* }
  );*/
  var customurl = <?php echo $this->getLayout()->createBlock('Magento/Sales/Block/Order/PrintOrder/Invoice')->setTemplate('Magento_Sales::order/totals.phtml')->toHtml(); ?>;
    var previewPopup = $('<div/>').html(customurl);
    previewPopup.modal({
      title: 'Invoice',
      innerScroll: true,
      responsive: true,
       // $.ajax({
          // url: customurl,
          
   
            // }),
      // modalClass: '_email-box',
      clickableOverlay: true,
      buttons: [{
        // type:'button',
        // text: $.mage.__('Close'),
        // class: '',
        click: function () {
          $("form").validation().submit();
       }}
      ]}).trigger('openModal');
     },

      getFieldHandler: function (row) {
         return this.preview.bind(this, row);
      }
    });
});
                