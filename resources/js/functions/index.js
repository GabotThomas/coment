//import { black, white } from '../constants/colors';
import { POST } from '../constants/methods';

export const parseBoolean = string => string === true || string === 'true';

export const removeSpaces = string => string.replace(/ +/g, '');

export const formatFileName = string => string.replace(/\/+/g, '-').replace(/:+/g, '');

export const roundFloat = number =>
    typeof number === 'number' ? parseFloat(number.toFixed(2)) : number;

export const calcPercentOf = (value, total) => roundFloat((value * 100) / total);

// prettier-ignore
export const objectToGETparams = object => Object.entries(object).reduce(
    (params, [key, value]) => value !== undefined
        ? `${params}${params ? '&' : '?'}${key}=${encodeURIComponent(value)}`
        : params,
    ''
);

/**
 * @argument {args} classList of [string, array, false, null, undefined]
 * @returns {string}
 */
export const makeClassName = (...classList) =>
    classList.reduce((classList, className) => {
        if (!className) return classList;
        if (Array.isArray(className)) className = makeClassName(className);
        if (!classList) return className;
        return classList + ' ' + className;
    }, '');
// faster than classList.flat().filter(c => c).join(' ')

export function colorPrices(price) {
    if (price > 0) {
        return 'text-green';
    }
    if (price < 0) {
        return 'text-red';
    }
    return undefined;
}

/**
 * @param {number} nb
 * @param {boolean} decimal
 * @returns {string}
 */
export function formatPrices(price, decimal = true) {
    const nbDigit = decimal ? 2 : 0;
    // prevent from -0,00 for very small negative values
    if (price > -0.005 && price < 0.005) price = 0;
    price = new Intl.NumberFormat('fr-FR', {
        minimumFractionDigits: nbDigit,
        maximumFractionDigits: nbDigit,
    }).format(price);
    // firefox blankspace bug
    price = price.replace(/\s+/g, '\u00A0');
    return price + '\u00A0€';
}
/**
 * @param {number} nb
 * @param {number} minDigit
 * @param {number} maxDigit
 * @returns {string}
 */
export function formatPercent(percent, minDigit = 0, maxDigit = 2) {
    // minDigit is only applicable on floats for percents
    if (!Number.isInteger(percent)) {
        // prevent from -0,00 for very small negative values
        if (percent > -0.005 && percent < 0.005) percent = 0;
        percent = new Intl.NumberFormat('fr-FR', {
            minimumFractionDigits: minDigit,
            maximumFractionDigits: maxDigit,
        }).format(percent);
        // firefox blankspace bug
        percent = percent.replace(/\s+/g, '\u00A0');
    }
    return percent + '\u00A0%';
}

/**
 * @param {string} siret
 * @returns {string}
 */
export const formateSiret = siret =>
    `${siret.slice(0, 3)} ${siret.slice(3, 6)} ${siret.slice(6, 9)} ${siret.slice(9)}`;

/**
 * @param  {string} r
 * @param  {string} g
 * @param  {string} b
 * @return {string}
 */
export const rgbToHex = (...rgb) =>
    rgb.reduce((hex, colorRate) => {
        let hexRate = Number(colorRate).toString(16);
        if (hexRate.length < 2) hexRate = '0' + hexRate;
        return hex + hexRate;
    }, '#');

/**
 * @param  {string} r
 * @param  {string} g
 * @param  {string} b
 * @return {string}
 */
export const getConstrastedColor = (r, g, b) =>
    r * 0.299 + g * 0.587 + b * 0.114 > 149 ? black : white;

export function scrollToTopAnimate() {
    window.scrollTo({ behavior: 'smooth', left: 0, top: 0 });
}

/**
 * @param {object} object1
 * @param {object} object2
 * @returns {boolean} true = same | false = different
 */
export function objectCompare(object1, object2) {
    if (object1 == null && object2 == null) {
        return true;
    } else if (object1 == null || object2 == null) {
        return false;
    }
    if (Object.keys(object1).length !== Object.keys(object2).length) {
        return false;
    }
    for (let [key, value] of Object.entries(object1)) {
        if (typeof value === 'object' && typeof object2[key] === 'object') {
            if (!objectCompare(value, object2[key])) {
                return false;
            }
        } else if (value !== object2[key]) {
            return false;
        }
    }
    return true;
}

/**
 * @param {object} data
 * @returns {FormData}
 */
export function buildFormData(data) {
    const formData = new FormData();
    Object.entries(data).map(([key, value]) => formData.append(key, value));
    return formData;
}

/**
 * @param {Blob|File} blob
 * @param {string} filename
 * @return {Promise}
 */
export const autoDownload = (blob, filename) =>
    new Promise((resolve, reject) => {
        if (!(blob instanceof Blob) && !(blob instanceof File)) {
            console.error(
                new TypeError('blob parameter should be an instance of Blob or File.')
            );
            reject(
                new TypeError(
                    "Le fichier n'a pas pu être téléchargé, suite à une erreur dans la réception des données."
                )
            );
        }
        filename = formatFileName(filename);
        if (window.navigator && window.navigator.msSaveBlob) {
            window.navigator.msSaveBlob(blob, filename);
        } else {
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style = 'display: none';
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        }
        resolve(true);
    });

/**
 * @param {blob} blob
 */
export function openBlob(blob) {
    if (window.navigator && window.navigator.msSaveOrOpenBlob) {
        window.navigator.msSaveOrOpenBlob(blob);
    } else {
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.style = 'display: none';
        a.href = url;
        a.target = '_blank';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        // Cannot revoke url else user could not download file
    }
}

export function redirectForm({ method = POST, action, inputs }) {
    const form = document.createElement('form');
    form.style = 'display: none';
    form.action = action;
    form.method = method;
    Object.entries(inputs).forEach(([name, value]) => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = value;
        form.appendChild(input);
    });
    document.body.appendChild(form);
    form.submit();
}
