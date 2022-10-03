/**
 * Created By : Rohan Hapani
 */
var config = {
    paths: {
        'owlcarouselcatalog': "Magento_Catalog/js/owl.carousel"
    },
    map: {
        '*' : {
            'owlcarouselcatalog': "Magento_Catalog/js/owl.carousel"
        }
    },
    shim: {
        'owlcarouselcatalog': {
            deps: ['jquery']
        },
        carousel: {
            deps: ['owlcarouselcatalog']
        }
    }
};