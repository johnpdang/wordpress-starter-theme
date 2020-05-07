// Add [data-notab] to any html element you don't want to be tabbable 
import Dom from '../Utility/Dom';

const Modal = {
    open: function(target){
        for (let element of Dom.focusable) {   
            $(element).attr('tabindex', '-1');
            if(element !== '*[data-notab]'){
                target.find(element).attr('tabindex', '1');
            }
        }
    },
    close: function(target){
        for (let element of Dom.focusable) {
            element !== '*[data-notab]' 
              ? $(element).attr('tabindex', '1')
              : $(element).attr('tabindex', '-1');

            target.find(element).attr('tabindex', '-1');
        }
    }
}


export default Modal;