jQuery.validator.addMethod("letras_espacios", function(value, element) {
    return this.optional(element) || /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+[a-z0-9A-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(value);
}, "Sólo letras y números");

jQuery.validator.addMethod("solo_letras", function(value, element) {
    return this.optional(element) || /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(value);
}, "Sólo letras");

jQuery.validator.addMethod("nombre_persona", function(value, element) {
    return this.optional(element) || /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+\.?[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(value);
}, "Sólo letras y un punto");

jQuery.validator.addMethod("nombre_guion", function(value, element) {
    return this.optional(element) || /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+\-?[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(value);
}, "Sólo letras y un guion");

jQuery.validator.addMethod("letras_numeros", function(value, element) {
    return this.optional(element) || /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s]*$/.test(value);
}, "Sólo letras y numeros");

jQuery.validator.addMethod("nombre_semestre", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]*$/.test(value);
}, "Sólo letras, numeros y el caracter #");

jQuery.validator.addMethod("tipo_siglema", function(value, element) {
    return this.optional(element) || /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s]+\-?[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s]+$/.test(value);
}, "Sólo letras y un guion");