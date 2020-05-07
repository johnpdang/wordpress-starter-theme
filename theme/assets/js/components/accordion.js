import Dom from '../Utility/Dom.js';

const accordion = () => {
    Dom.accordionHeader.on('click', (e) => {
        const vidSrc = $(e.currentTarget).data('video-src');
        const replaceSrc = $(Dom.toggleVidSrc).attr('src');
        $(Dom.accordionBody).addClass('collapsed');
        $(e.currentTarget).siblings(Dom.accordionBody).toggleClass('collapsed');
        if(vidSrc !== replaceSrc){
            $(Dom.toggleVidSrc).attr('src', vidSrc);
        }
    })
}

export default accordion;
