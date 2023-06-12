import $ from 'jquery';
import 'bootstrap';

$(document).ready(function () {
    $('#btn-mentores').hide();
    $("#form-select-tipo-usuario").change(function () {
        if ($(this).val() === "usuario") {
            $("#usuario-campos").show();
            $(".required-usuario").prop("required", true);
            $("#entidad-campos").hide();
            $(".required-entidad").prop("required", false);
            $('#btn-mentores').show();
        } else if ($(this).val() === "entidad") {
            $("#usuario-campos").hide();
            $(".required-usuario").prop("required", false);
            $("#entidad-campos").show();
            $(".required-entidad").prop("required", true);
            $('#btn-mentores').show();
        } else {
            $("#usuario-campos").hide();
            $(".required-usuario").prop("required", false);
            $("#entidad-campos").hide();
            $(".required-entidad").prop("required", false);
            $('#btn-mentores').hide();
        }
    });
});