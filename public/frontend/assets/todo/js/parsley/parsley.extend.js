window.ParsleyConfig = window.ParsleyConfig || {};

(function ($) {
  window.ParsleyConfig = $.extend( true, {}, window.ParsleyConfig, {
    validators: {
      minwords: function ( val, nbWords ) {
        val = val.replace( /(^\s*)|(\s*$)/gi, "" );
        val = val.replace( /[ ]{2,}/gi, " " );
        val = val.replace( /\n /, "\n" );
        val = val.split(' ').length;

        return val >= nbWords;
      }

      , maxwords : function ( val, nbWords ) {
        val = val.replace( /(^\s*)|(\s*$)/gi, "" );
        val = val.replace( /[ ]{2,}/gi, " " );
        val = val.replace( /\n /, "\n" );
        val = val.split(' ').length;

        return val <= nbWords;
      }

      , rangewords: function ( val, obj ) {
        val = val.replace( /(^\s*)|(\s*$)/gi, "" );
        val = val.replace( /[ ]{2,}/gi, " " );
        val = val.replace( /\n /, "\n" );
        val = val.split(' ').length;

        return val >= obj[0] && val <= obj[1];
      }

      , greaterthan: function ( val, elem, self ) {
        self.options.validateIfUnchanged = true;

        return new Number(val) > new Number($( elem ).val());
      }

      , lessthan: function ( val, elem, self ) {
        self.options.validateIfUnchanged = true;

        return new Number(val) < new Number($( elem ).val());
      }

      , beforedate: function ( val, elem, self) {
        return Date.parse(val) < Date.parse($(elem).val());
      }

      , afterdate: function ( val, elem, self) {
        return Date.parse($(elem).val()) < Date.parse(val);
      }

      , inlist: function ( val, list, self ) {
        var delimiter = self.options.inlistDelimiter || ',';
        var listItems = (list + "").split(new RegExp("\\s*\\" + delimiter + "\\s*"));

        return (listItems.indexOf(val.trim()) !== -1);
      }

      , luhn: function ( val, elem, self) {
        val = val.replace(/[ -]/g, '');
        var digit, n, sum, _j, _len1, _ref2;
        sum = 0;
        _ref2 = val.split('').reverse();
        for (n = _j = 0, _len1 = _ref2.length; _j < _len1; n = ++_j) {
          digit = _ref2[n];
          digit = +digit;
          if (n % 2) {
            digit *= 2;
            if (digit < 10) {
              sum += digit;
            } else {
              sum += digit - 9;
            }
          } else {
            sum += digit;
          }
        }
        return sum % 10 === 0;
      }

      , americandate: function ( val, elem, self) {
        if(!/^([01]?[0-9])[\.\/-]([0-3]?[0-9])[\.\/-]([0-9]{4}|[0-9]{2})$/.test(val)) {
        	return false;
        }
        var parts = val.split(/[.\/-]+/);
        var day = parseInt(parts[1], 10);
        var month = parseInt(parts[0], 10);
        var year = parseInt(parts[2], 10);
        if(year == 0 || month == 0 || month > 12) {
          return false;
        }
        var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];
        if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0)) {
          monthLength[1] = 29;
        }
        return day > 0 && day <= monthLength[month - 1];
      }


      , cedula: function(val, allowed) {

            alert('in');
            var total_caracteres = val.length;
            if(total_caracteres == 10)
            {

                var nro_region = val.substring(0, 2);
                var val_nro_region = parseInt(nro_region);

                if(val_nro_region>=1 && val_nro_region<=24)
                {

                    var ult_digito = val.substring(9,10);

                    var valor2=val.substring(1, 2);
                    var valor4=val.substring(3, 4);
                    var valor6=val.substring(5, 6);
                    var valor8=val.substring(7, 8);

                    var suma_pares=(parseInt(valor2) + parseInt(valor4) + parseInt(valor6)+ parseInt(valor8));

                    var valor1=val.substring(0, 1);
                    valor1=(valor1 * 2);
                    if(valor1>9){ valor1=(valor1 - 9); }
                    var valor3=val.substring(2, 3);
                    valor3=(valor3 * 2);
                    if(valor3>9){ valor3=(valor3 - 9); }
                    var valor5=val.substring(4, 5);
                    valor5=(valor5 * 2);
                    if(valor5>9){ valor5=(valor5 - 9); }
                    var valor7=val.substring(6, 7);
                    valor7=(valor7 * 2);
                    if(valor7>9){ valor7=(valor7 - 9); }
                    var valor9=val.substring(8, 9);
                    valor9=(valor9 * 2);
                    if(valor9>9){ valor9=(valor9 - 9); }


                    var suma_impares=(parseInt(valor1) + parseInt(valor3) + parseInt(valor5) + parseInt(valor7) + parseInt(valor9));

                    var suma=(suma_pares + suma_impares);

                    var dis=suma.toString().substring(0,1);

                    var dis_int=((parseInt(dis) + 1)* 10);

                    var digito=(dis_int - suma);

                    if(digito==10){ digito=0; }

                    if(digito.toString() == ult_digito)
                    { return true; }
                    else
                    { return false; }

                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }


        }




    }
    , messages: {
        minwords:       "This value should have %s words at least."
      , maxwords:       "This value should have %s words maximum."
      , rangewords:     "This value should have between %s and %s words."
      , greaterthan:    "This value should be greater than %s."
      , lessthan:       "This value should be less than %s."
      , beforedate:     "This date should be before %s."
      , afterdate:      "This date should be after %s."
      , luhn:           "This value should pass the luhn test."
      , americandate:	"This value should be a valid date (MM/DD/YYYY)."
      , cedula:         "El número de cédula ingresado no es correcto"
    }
  });
}(window.jQuery || window.Zepto));
