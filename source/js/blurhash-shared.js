/** Manually built from BlurHash TypeScript code. **/

var digitCharacters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz#$%*+,-.:;=?@[]^_{|}~".split('');

var sRGBToLinear = function (value) {
    var v = value / 255;
    if (v <= 0.04045) {
        return v / 12.92;
    }
    else {
        return Math.pow((v + 0.055) / 1.055, 2.4);
    }
};

var linearTosRGB = function (value) {
    var v = Math.max(0, Math.min(1, value));
    if (v <= 0.0031308) {
        return Math.round(v * 12.92 * 255 + 0.5);
    }
    else {
        return Math.round((1.055 * Math.pow(v, 1 / 2.4) - 0.055) * 255 + 0.5);
    }
};

var sign = function (n) { return (n < 0 ? -1 : 1); };

var signPow = function (val, exp) {
    return sign(val) * Math.pow(Math.abs(val), exp);
};

