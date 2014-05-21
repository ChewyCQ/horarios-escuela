jQuery.validator.addMethod("letras_espacios", function(value, element) {
    return this.optional(element) || /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+[a-z0-9A-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(value);
}, "Sólo letras y números");
jQuery.validator.addMethod("solo_letras", function(value, element) {
    return this.optional(element) || /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(value);
}, "Sólo letras");
jQuery.validator.addMethod("nombre_persona", function(value, element) {
    return this.optional(element) || /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+\.?[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(value);
}, "Sólo letras y un punto");