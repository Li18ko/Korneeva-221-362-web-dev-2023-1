document.getElementById("calculateButton").addEventListener("click", function() {
    const base = document.getElementById("powBase").value;
    const exponent = document.getElementById("powExponent").value;
    const result = document.getElementById("powResult");

    result.textContent = pow(base, exponent);
});

function pow(x, n) {
    if (x < 0){
        return "Некорректное значение";
    }
    if (n === 0) {
        return 1;
    }
    let result = x;
    for (let i = 1; i < n; i++) {
        result *= x;
    }
    return result;
}


document.getElementById("calculateGcd").addEventListener("click", function() {
    const a = document.getElementById("gcd_a").value;
    const b = document.getElementById("gcd_b").value;
    const result = document.getElementById("gcd_result");

    result.textContent = gcd(a, b);
});

function gcd(a, b) {
    if ((a < 0) || (b < 0)){
        return "Некорректное значение";
    }
    while (b !== 0) {
        let t = b;
        b = a % b;
        a = t;
    }
    return a;
}


document.getElementById("findMinDigit").addEventListener("click", function() {
    const x = document.getElementById("min_digit").value;
    const result = document.getElementById("min_digit_result");

    result.textContent = minDigit(x);
});

function minDigit(x) {
    if (x < 0){
        return "Некорректное значение";
    }
    let min = 9;
    while (x > 0) {
        let digit = x % 10;
        if (digit < min) {
            min = digit;
        }
        x = Math.floor(x / 10);
    }
    return min;
}


document.getElementById("generatePluralizedString").addEventListener("click", function() {
    const n = document.getElementById("pluralize").value;
    const result = document.getElementById("pluralize_result");

    result.textContent = pluralizeRecords(n);
});

function pluralizeRecords(n) {
    if (n < 0){
        return "Некорректное значение";
    }
    let pluralForm = "";
    if (n % 10 === 1 && n % 100 !== 11) {
        pluralForm = "запись";
        x = "была найдена";
    } else if ((n % 10 >= 2 && n % 10 <= 4) && (n % 100 < 12 || n % 100 > 14)) {
        pluralForm = "записи";
        x = "были найдены";
    } else if(n % 10 === 0 || (n % 10 >= 5 && n % 10 <= 9) || (n % 100 >= 11 && n % 100 <= 14)){
        pluralForm = "записей";
        x = "было найдено";
    } 
    return `В результате выполнения запроса ${x} ${n} ${pluralForm}`;
}


document.getElementById("calculateFibb").addEventListener("click", function() {
    const n = document.getElementById("fibb").value;
    const result = document.getElementById("fibb_result");

    result.textContent = fibb(n);
});

function fibb(n) {
    if (n < 0 || n > 1000){
        return "Некорректное значение";
    }
    if (n <= 2) {
        return 1;
    }
    let s = 0;
    let a = 1;
    let b = 1;
    for (let i = 2; i < n; i++) {
        s = a + b;
        a = b;
        b = s;
    }
    return s;
}