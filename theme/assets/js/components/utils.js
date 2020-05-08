// used for window resize/scroll functions to reduce function calls
export function debouncer(func, timeout) {
    var timeoutID, timeout = timeout || 20;
    return function () {
        var scope = this, args = arguments;
        clearTimeout(timeoutID);
        timeoutID = setTimeout(function () {
            func.apply(scope, Array.prototype.slice.call(args));
        }, timeout);
    };
}
