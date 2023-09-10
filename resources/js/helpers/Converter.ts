export const NumberAddComma = (num: number)  => {
    if(num) {
        let _num = Number(num).toFixed(2);
        return _num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    return '0.00'
}
