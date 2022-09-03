$("#contact1").on('input',function(){
    this.type = 'text';
    var input = this.value;
    if (/\D\/$/.test(input)) input = input.substr(0, input.length - 4);
    var values = input.split('-').map(function(v) {
        return v.replace(/\D/g, '')
    });
    if (values[0]) values[0] = checkValue(values[0], 12);
    if (values[1]) values[1] = checkValue(values[1], 31);
    var output = values.map(function(v, i) {
        return v.length == 2 && i < 2 ? v + '-' : v;
    });
    this.value = output.join('').substr(0, 14);
});