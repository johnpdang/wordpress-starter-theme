const Dom = {
    'body'              : $('body'),

    // accesibility
    'focusable'         : ["a[href]", " area[href]", " input:not([disabled])", " select:not([disabled])", " textarea:not([disabled])", " button:not([disabled])", "object", "embed", " *[tabindex]", " *[contenteditable]", '*[data-notab]'],

    // Accordion
    'accordionHeader'   : $('.accordion__header'),
    'accordionBody'     : $('.accordion__body'),
    'toggleVidSrc'      : $('[data-toggle-src]'),

    // menu trigger
    'menuModal'         : $('#menuPanelOverlay'),
    'menuTrigger'       : $('[menu-target]'),
    'closeMenu'         : $('[data-dismiss="menu"]'),
    'closeMenuButton'   : $('[close-menu-button]'),
    'menuGroup'         : $('.screen-overlay__content'),
    // 'menuLinks'         : $('.menu-link__item'),
    'menuLinks'         : $('.has-dropdown-link'),

    // Modal
    'modalTrigger'      : $('[modal-target]'),
    'closeModal'        : $('[data-dismiss="modal"]'),
    'closeAnyModal'     : $('[data-dismiss="allModal"]'),
    'btnGroup'          : $('.close-btn-group'),
    'closeButton'       : $('[close-button]'),

    // Slider
    'instructorsSlider' : $('[js-instructors-slider]'),
}

export default Dom;
