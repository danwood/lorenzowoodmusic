var encode83 = function (n, length) {
    var result = "";
    for (var i = 1; i <= length; i++) {
        var digit = (Math.floor(n) / Math.pow(83, length - i)) % 83;
        result += digitCharacters[Math.floor(digit)];
    }
    return result;
};

var bytesPerPixel = 4;
var multiplyBasisFunction = function (pixels, width, height, basisFunction) {
    var r = 0;
    var g = 0;
    var b = 0;
    var bytesPerRow = width * bytesPerPixel;
    for (var x = 0; x < width; x++) {
        for (var y = 0; y < height; y++) {
            var basis = basisFunction(x, y);
            r +=
                basis * sRGBToLinear(pixels[bytesPerPixel * x + 0 + y * bytesPerRow]);
            g +=
                basis * sRGBToLinear(pixels[bytesPerPixel * x + 1 + y * bytesPerRow]);
            b +=
                basis * sRGBToLinear(pixels[bytesPerPixel * x + 2 + y * bytesPerRow]);
        }
    }
    var scale = 1 / (width * height);
    return [r * scale, g * scale, b * scale];
};

var encodeDC = function (value) {
    var roundedR = linearTosRGB(value[0]);
    var roundedG = linearTosRGB(value[1]);
    var roundedB = linearTosRGB(value[2]);
    return (roundedR << 16) + (roundedG << 8) + roundedB;
};
var encodeAC = function (value, maximumValue) {
    var quantR = Math.floor(Math.max(0, Math.min(18, Math.floor(signPow(value[0] / maximumValue, 0.5) * 9 + 9.5))));
    var quantG = Math.floor(Math.max(0, Math.min(18, Math.floor(signPow(value[1] / maximumValue, 0.5) * 9 + 9.5))));
    var quantB = Math.floor(Math.max(0, Math.min(18, Math.floor(signPow(value[2] / maximumValue, 0.5) * 9 + 9.5))));
    return quantR * 19 * 19 + quantG * 19 + quantB;
};
var encode = function (pixels, width, height, componentX, componentY) {
    if (componentX < 1 || componentX > 9 || componentY < 1 || componentY > 9) {
        throw new ValidationError("BlurHash must have between 1 and 9 components");
    }
    if (width * height * 4 !== pixels.length) {
        throw new ValidationError("Width and height must match the pixels array");
    }
    var factors = [];
    var _loop_1 = function (y) {
        var _loop_2 = function (x) {
            var normalisation = x == 0 && y == 0 ? 1 : 2;
            var factor = multiplyBasisFunction(pixels, width, height, function (i, j) {
                return normalisation *
                    Math.cos((Math.PI * x * i) / width) *
                    Math.cos((Math.PI * y * j) / height);
            });
            factors.push(factor);
        };
        for (var x = 0; x < componentX; x++) {
            _loop_2(x);
        }
    };
    for (var y = 0; y < componentY; y++) {
        _loop_1(y);
    }
    var dc = factors[0];
    var ac = factors.slice(1);
    var hash = "";
    var sizeFlag = componentX - 1 + (componentY - 1) * 9;
    hash += encode83(sizeFlag, 1);
    var maximumValue;
    if (ac.length > 0) {
        var actualMaximumValue = Math.max.apply(Math, ac.map(function (val) { return Math.max.apply(Math, val); }));
        var quantisedMaximumValue = Math.floor(Math.max(0, Math.min(82, Math.floor(actualMaximumValue * 166 - 0.5))));
        maximumValue = (quantisedMaximumValue + 1) / 166;
        hash += encode83(quantisedMaximumValue, 1);
    }
    else {
        maximumValue = 1;
        hash += encode83(0, 1);
    }
    hash += encode83(encodeDC(dc), 4);
    ac.forEach(function (factor) {
        hash += encode83(encodeAC(factor, maximumValue), 2);
    });
    return hash;
};


